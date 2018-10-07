# Installation steps:

1. add this to "repositories" section of your composer.json file :

"repositories": [
        ...
        {
            "type": "vcs",
            "url": "https://github.com/alexeyplumtreegroup/module-custom-catalog"
        }
    ],


2. docker-compose run cli bash

3. composer require alexeyplumtreegroup/module-custom-catalog:dev-master

4. exit  from cli

5. docker-compose run cli magento-command setup:upgrade
