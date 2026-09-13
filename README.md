# GridField Paginator With Show All

[![Latest Stable Version](https://img.shields.io/packagist/v/normann/gridfieldpaginatorwithshowall.svg)](https://packagist.org/packages/normann/gridfieldpaginatorwithshowall)
[![Total Downloads](https://img.shields.io/packagist/dt/normann/gridfieldpaginatorwithshowall.svg)](https://packagist.org/packages/normann/gridfieldpaginatorwithshowall)
[![License](https://img.shields.io/badge/license-BSD--3--Clause-blue.svg)](LICENSE)

An extension of SilverStripe's `GridFieldPaginator` that adds a **"Show all"** checkbox
to the bottom of a `GridField`, letting CMS users toggle between the normal paginated
view and a single page containing every record in the list.

> **SilverStripe compatibility:** this branch targets **SilverStripe 3.1+** only.
> Support for SilverStripe 4, 5 and 6 is planned — see [Roadmap](#roadmap) below.

## Requirements

* PHP 5.3+ (whatever your SilverStripe 3 install already requires)
* [`silverstripe/framework`](https://github.com/silverstripe/silverstripe-framework) ~3.1
* Composer, with [`composer/installers`](https://github.com/composer/installers)

## Installation

Install via Composer:

```bash
composer require normann/gridfieldpaginatorwithshowall
```

Then run a `dev/build?flush=1` so SilverStripe picks up the module's templates,
CSS and JavaScript.

## Usage

Swap out the standard `GridFieldPaginator` for `GridFieldPaginatorWithShowAll` on
any `GridField` config, for example inside `getCMSFields()`:

```php
$gridField = $fields->dataFieldByName('MyRelation');
$config = $gridField->getConfig();

$config
    ->removeComponentsByType('GridFieldPaginator')
    ->addComponent(new GridFieldPaginatorWithShowAll());
```

Once added, a "Show all" checkbox appears alongside the normal pagination
controls. Ticking it lists every record in the `GridField` on one page;
unticking it returns to the regular paginated view.

> **Note:** if the class name above doesn't match what's in `code/forms/` in
> your checkout, please open an issue (or a PR!) so the docs can be corrected —
> see [Contributing](#contributing).

## Configuration

Like the core paginator, the number of items shown per page can still be set
via `setItemsPerPage()`:

```php
$paginator = new GridFieldPaginatorWithShowAll(20);
```

Translations live under [`lang/`](lang) — feel free to add or improve one for
your locale and send a pull request.

## Roadmap

This module was written for SilverStripe 3 back in 2013 and hasn't been
updated for the namespaced (SilverStripe 4+) release line. Planned work:

- [ ] Add `.github/workflows` CI (GitHub Actions) to replace the old
  Travis CI / Scrutinizer setup
- [ ] Namespace the code and add a SilverStripe 4 compatible branch/tag
- [ ] Verify/update for SilverStripe 5
- [ ] Verify/update for SilverStripe 6
- [ ] Add automated tests covering the "show all" toggle behaviour
- [ ] Add a screenshot to this README

Contributions and testing on newer SilverStripe versions are very welcome.

## Contributing

Bug reports and pull requests are welcome on GitHub. Please see
[CONTRIBUTING.md](CONTRIBUTING.md) for guidelines before opening a PR.

## License

Released under the [BSD-3-Clause license](LICENSE).

## Maintainers

* [Normann Lou](https://github.com/normann)
