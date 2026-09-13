# Contributing

Thanks for considering a contribution to this module! It's a small, old
project (originally written for SilverStripe 3 in 2013) that's now being
brought forward to support newer SilverStripe releases, so help is very
welcome.

## Reporting issues

When filing an issue, please include:

* The module version (or commit) you're using
* The SilverStripe framework/CMS version you're running
* PHP version
* Steps to reproduce the problem, and what you expected to happen instead
* Any relevant error messages or stack traces

## Submitting a pull request

1. Fork the repository and create a branch off `master` (or the relevant
   version branch, e.g. `4`, `5`, `6` once those exist).
2. Keep pull requests focused — one fix or feature per PR is easier to
   review than a large mixed changeset.
3. Match the existing code style (see `.editorconfig`).
4. Add or update tests under `tests/` where practical.
5. Update `README.md` / `CHANGELOG.md` if your change affects usage or is
   user-facing.
6. Make sure `composer.json`'s `require` block reflects any new minimum
   version constraints your change needs.

## Multi-version support

This module aims to support several SilverStripe major versions over time
(3, 4, 5, 6). Where behaviour differs between versions, please:

* Prefer separate version branches/tags over runtime version-sniffing where
  the APIs have diverged significantly (e.g. the SilverStripe 3 → 4
  namespace change).
* Note any version-specific caveats in the README.

## Code of conduct

Be respectful and constructive. Assume good intent, and keep discussion
focused on the code and the issue at hand.
