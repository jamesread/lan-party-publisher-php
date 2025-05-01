# CONTRIBUTING

We welcome all contributions, whether they involve code, documentation, or other improvements. Your time and effort in enhancing this project are greatly appreciated, whether this is your first open-source contribution or you are an experienced maintainer.

If you are unsure where to start, consider opening an issue to discuss potential contributions.

Discussions should focus on technical merits and project-related concerns. We strive to maintain a respectful and inclusive environment, following the [Linux Kernel code of conduct](https://www.kernel.org/doc/html/latest/process/code-of-conduct.html).

## Contribution Guidelines

### Changes Exceeding Three Lines

If your proposed change involves more than three lines of code, please discuss it with the maintainers before proceeding. This helps ensure alignment with the project's direction and prevents unnecessary work.

### Contribution Process
1. Fork the repository.
1. Create a new branch.
1. Develop, test, commit, and push your changes.
1. Submit a pull request (PR) with a detailed description. Please adhere to the [pull request template](.github/PULL_REQUEST_TEMPLATE.md).

### Coding Standards

- Ensure code style compliance by running:
```bash
composer lint
```
- Maintain a meaningful commit history.
- Rebase as necessary to avoid merge conflicts [(Learn more)](https://git-scm.com/book/en/v2/Git-Branching-Rebasing).
- Follow Semantic Versioning [(SemVer)](http://semver.org/).

### Development Setup

1. Clone your fork and install dependencies:
```bash
composer install
```
2. Lint your code:
```bash
composer lint
```
3. Run tests:
```bash
composer test
```
4. Perform static analysis:
```bash
composer analyse
```

### Pull Requests: One Logical Change at a Time

To facilitate efficient reviews, keep PRs focused on a single logical change. Large, multifaceted PRs are difficult to review and may be rejected. If necessary, break your changes into smaller, incremental PRs.

## Seeking Guidance

If you are unsure about a contribution, do not hesitate to ask. Larger changes, especially those impacting core functionality or architecture, should be discussed in advance. Some long-term plans may not be fully documented, so reaching out ensures your contributions align with the project's roadmap.

For discussions, GitHub issues are the preferred communication channel.

## Submitting a Pull Request

Before submitting a PR, please review the [pull request template](.github/PULL_REQUEST_TEMPLATE.md) to ensure compliance.

## Code of Conduct

This project adheres to the Laravel Code of Conduct. Any violations should be reported appropriately.

- Be respectful of differing opinions.
- Avoid personal attacks and disparaging remarks.
- Assume good intent in discussions.
- Harassment in any form will not be tolerated.

Thank you for your contributions and for helping to improve this project!
