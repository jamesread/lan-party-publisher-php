# Changelog

All notable changes to this project are documented here. This library follows [Semantic Versioning](https://semver.org/).

## Version 2.0.0

Initial release of library v2, implementing [LAN Party Publishing Standard v2](https://github.com/jamesread/lan-party-publishing-standard).

### Breaking changes

- `apiVersion` is now `2` on all typed objects.
- `siteUniqueId` renamed to `publisherUniqueId` (required; auto-generated from `name` when omitted).
- Organisation: `bannerImagePngUrl` replaced by `image`; added `discordInviteUrl`.
- Venue: `gpsLongditude` corrected to `gpsLongitude`; added `countryCode`.
- Event: `start`/`finish` renamed to `startDate`/`endDate` (ISO 8601 `YYYY-MM-DDTHH:MM:SS`).
- Event: `seatsTotal`/`seatsAvailable` replaced by `maximumAttendeeCapacity`/`remainingAttendeeCapacity`.
- Event: informal ticket fields replaced by a `tickets[]` array via the new `Ticket` model.
- Event: boolean policy flags replaced by bitset fields (`alcoholPolicy`, `smokingPolicy`, `agePolicy`, `foodPolicy`).
- `Attendee` removed from the standard and this library.
- `$schema` now points at the v2 JSON schema URL.

### Added

- `Ticket` model and enums for event status, attendance mode, ticket availability, and policy bitsets.
- `Publisher::omitNulls()` — optional fields with no value are omitted from JSON output.
- Reference example recreating the standard's [pixel-pit.json](https://github.com/jamesread/lan-party-publishing-standard/blob/main/example-outputs/pixel-pit.json).

### Migration from v1.x

Stay on `^1` of this library if you need to publish standard v1 documents. For v2, require `^2` and follow the [standard's migration guide](https://github.com/jamesread/lan-party-publishing-standard/blob/main/CHANGELOG.md).

## Version 1.x

See [GitHub releases](https://github.com/jamesread/lan-party-publisher-php/releases) for v1.x history.
