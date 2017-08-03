# pilot-live-php

[PilotLive API](https://gateway.pilotlive.co.za/PilotGateway/PilotWebGateway.svc/help) client for PHP

This will be a 100% fully unit tested and (mostly) fully featured unofficial PHP
client for PilotLive

You will eventually be able to install with:

```bash
composer require darrynten/pilot-live-php
```

PHP 7.0+

## Basic use

### Definitions

# TODO

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
- [ ] Open Tables
  - [ ] Open Table Collection
  - [ ] Open Table Model
  - [ ] Items Collection
  - [ ] Open Table Detail (Item) Model
  - [ ] Open Table List
  - [ ] Open Table Detail
  - [ ] New Open Table
- [ ] Supplier Invoice
  - [ ] Supplier Invoice 'Header' Collection
  - [ ] Supplier Invoice 'Header' Model
  - [ ] Supplier Invoice Details Collection
  - [ ] Supplier Invoice Detail Model
  - [ ] Processed
  - [ ] Unprocessed
- [ ] Vendor Payments
  - [ ] Vendor Payment Collection
  - [ ] Vendor Payment Model
  - [ ] List Payments
  - [ ] Processed Payments
  - [ ] App Payment
  - [ ] Zapper Payment

# ==== END OF INITIAL DELIVERY ====

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
