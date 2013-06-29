Silex RESTfull Address Book
================

## Installation ##

Needed software:
 - Composer
 - Git

Local checkout

    # Clone project
    git clone ssh://git@forked-repo.git

    # Go to clone and run
    composer update

================

## JSON API: ##

    # Data format:
    {
        "id": "13",
        "label": "My addrXX",
        "street": "Artema",
        "housenumber": "4",
        "postalcode": "83001",
        "city": "Donetsk",
        "country": "Ukraine"
    }

    # GET /api/ - get list of all addresses
    response:
    [ { <see Data format> }, { <see Data format> }, ... ]

    # GET /api/{id} - get address with specified id
    response:
    { <see Data format> }

    # POST /api/ - create new
    # PUT /api/{id} - update existing
    # DELETE /api/{id} - delete address with specified id
    params: { <see Data format> }
    response:
    {
        "hasErrors": false,
        "errors": null,
        "Id": "13"
    }

================

## Manual Testing: ##

    $ curl /api/ -d '{"label":"test","street":"test",...}' -H 'Content-Type: application/json'