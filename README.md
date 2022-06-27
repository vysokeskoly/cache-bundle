CacheBundle
==============

[![Checks](https://github.com/vysokeskoly/cache-bundle/actions/workflows/checks.yaml/badge.svg)](https://github.com/vysokeskoly/cache-bundle/actions/workflows/checks.yaml)
[![Build](https://github.com/vysokeskoly/cache-bundle/actions/workflows/php-checks.yaml/badge.svg)](https://github.com/vysokeskoly/cache-bundle/actions/workflows/php-checks.yaml)


Changelog
---------
See CHANGELOG.md

Installation
------------

### Step 1

Download using *composer*.

    "require": {
        "vysokeskoly/cache-bundle": "^5.1.0"
    },

### Step 2

Add *CacheBundle* to the list of loaded bundles. Configure required parameters for bundle.

**config.yml**

    vysokeskoly_cache:
        connections:
            data:
                persistent_id: vs
                servers:
                    default:
                        host: memc
                        port: 11211
            session:
                persistent_id: vs_session
                servers:
                    default:
                        host: memc
                        port: 11311

### Step3

Use created services. From example above *vs.cache.data* and *vs.cache.session*.
