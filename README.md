# Installation steps:

1. add this to "repositories" section of your composer.json file :
```
"repositories": [
        ...
        {
            "type": "vcs",
            "url": "https://github.com/alexeyplumtreegroup/module-custom-catalog"
        }
    ],

```
2. docker-compose run cli bash

3. composer require alexeyplumtreegroup/module-custom-catalog:dev-master

4. exit  from cli

5. docker-compose run cli magento-command setup:upgrade

# How to test API customization

1. Send first request and get token
```
curl -X POST "http://magento2.local/index.php/rest/V1/integration/admin/token" \
     -H "Content-Type:application/xml"  \
     -d "<login><username>admin</username><password>password1</password></login>"
```
2. curl -X GET "http://magento2.local/index.php/rest/V1/product/getByVPN/{vpn}" -H "Authorization: Bearer xxxxxxxxxxxxxxxxxx"

Where  xxxxxxxxxxxxxxxxxx   is your token.
