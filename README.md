Atrask Kauną
========================

Greitai raskite vertus dėmesio renginius.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nfq-akademija-2015-ruduo/Kas_vyksta_Kaune/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nfq-akademija-2015-ruduo/Kas_vyksta_Kaune/?branch=master)

--------------

"Atrask Kauną" konsolės komandos:

`app/console kvk:scrape:categories` - KVK kategorijų gavimas

`app/console kvk:scrape:events` - KVK renginių gavimas pagal kategorijas

`app/console kvk:facebook:events` - KVK renginių informacijos papildymas Facebook duomenimis, naudojant skelbta Facebook renginio nuoroda

--------------

Projekto paruošimas:

1. `composer install`

2. `bower install`; (`sudo bower --allow-root install`, jei trūksta teisių)

3. Duomenų bazė:
  1. `app/console doctrine:database:create`
  2. `app/console doctrine:schema:update --force`

4. Toliau paeiliui paleidžiame "Atrask Kauną" konsolės komandas.

--------------

Priklausomybės:

* `npm install bower -g`
