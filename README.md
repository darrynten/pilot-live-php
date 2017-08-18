# pilot-live-php

![Travis Build Status](https://travis-ci.org/darrynten/pilot-live-php.svg?branch=dev)
![StyleCI Status](https://styleci.io/repos/99255430/shield?branch=dev)
[![codecov](https://codecov.io/gh/darrynten/pilot-live-php/branch/dev/graph/badge.svg)](https://codecov.io/gh/darrynten/pilot-live-php)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/ce0fe741c45d4c40b66db03abe720454)](https://www.codacy.com/app/darrynten/pilot-live-php?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=darrynten/pilot-live-php&amp;utm_campaign=Badge_Grade)
[![Code Climate](https://codeclimate.com/github/darrynten/pilot-live-php/badges/gpa.svg)](https://codeclimate.com/github/darrynten/pilot-live-php)
[![Issue Count](https://codeclimate.com/github/darrynten/pilot-live-php/badges/issue_count.svg)](https://codeclimate.com/github/darrynten/pilot-live-php)
![Packagist Version](https://img.shields.io/packagist/v/darrynten/pilot-live-php.svg)
![MIT License](https://img.shields.io/github/license/darrynten/pilot-live-php.svg)

[PilotLive API](https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help) client for PHP

This will be a 100% fully unit tested and (mostly) fully featured unofficial PHP
client for PilotLive

You will eventually be able to install with:

```bash
composer require darrynten/pilot-live-php
```

PHP 7.0+

## Basic use

```php

$table = new OpenTable($this->config);
$detail = $table->detail('reference');

```

## Features

This is the basic outline of the project and is a work in progress.

Checkboxes have been placed at each section, please check them off
in this readme when submitting a pull request for the features you
have covered.

### Application base

* Guzzle is used for the communications (I think we should replace?)
* The library has 100% test coverage

The client is not 100% complete and is a work in progress, details below.

## Documentation

This will eventually fully mimic the documentation available on the site.
https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help

Each section must have a short explaination and some example code like on
the API docs page.

Checked off bits are complete.

# NB the project is evolving quickly

## This might be outdated

# NB initial delivery consists of:

- [ ] Base
- [ ] Exception Handling
- [ ] Real CRUD Response Mocks
- [x] Open Tables
  - [x] Open Table Model
  - [x] Items
  - [ ] Open Table List
  - [ ] Open Table Detail
- [x] Vendor Payments
  - [x] Vendor Payment Collection
  - [x] Vendor Payment Model
  - [x] List Payments
  - [x] Processed Payments

And any related models

Key methods

* VendorPayments/Add
* OpenTables/Detail

# ==== END OF INITIAL DELIVERY ====

Following this

- [x] Supplier Invoice
  - [x] Supplier Invoice 'Header' Model (as SupplierInvoice)
  - [x] Supplier Invoice Detail Model
  - [x] Processed
  - [x] Unprocessed
- [ ] Zapper
- [ ] Snapscan
- [ ] Masterpass

And any methods besides the two in the initial delivers.

## Deliverables

* 100% Test Coverage
* Full, extensive, verbose, and defensive unit tests
* Mocks if there are none for the model in the `tests/mocks` directory (convention
can be inferred from the existing names in the folders)

## Contributing and Testing

There is currently 100% test coverage in the project, please ensure that
when contributing you update the tests. For more info see CONTRIBUTING.md

We would love help getting decent documentation going, please get in touch
if you have any ideas.

## Acknowledgements

* [Fergus Strangways-Dixon](https://github.com/fergusdixon)
