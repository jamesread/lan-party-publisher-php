# Using the PHP Library

1. Upload [main/LanPartyPublishingLibrary.php](main/LanPartyPublishingLibrary.php) to somewhere on your site that has access to your events database. 
2. Write a "calling script" that uses the library to build the list of JSON events. Look at the several [php examples](examples) to help get you started. 

Normally you should put your calling script and the library in the same subdirectory to keep things together. You should not need to edit the library yourself, as it makes upgrades a real pain in the future. If there are problems with the library, just raise an issue on GitHub.
