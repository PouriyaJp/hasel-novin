<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Country Data Import and Live Search with Laravel

This Laravel project is designed to fetch country data from an external API, store it in a database, and provide a live search feature. It leverages Laravel's powerful tools to optimize performance, including caching and job processing.

## Features
- Automated Country Data Import: Fetches country data from the REST Countries API and stores it in a MySQL database.
- Efficient Data Storage: Uses bulk insertions and updates to handle large datasets efficiently.
- Live Search: Implements live search functionality for country names with cached results to optimize performance.
- Background Job Processing: Utilizes Laravel jobs to handle the data import process in the background.



## Components

###Controllers

SearchController :
- Manages the display of country data and handles AJAX requests for live search functionality.

Jobs :
- FetchCountriesJob : Fetches country data from the API, processes it, and stores it in the database using Laravel's upsert method for bulk insertions and updates.

Commands :
- ImportCountries Command: Triggers the FetchCountriesJob to import country data when executed via the Artisan CLI.

Models : 
- Country : Represents country data in the database, including English and Persian names, flag URL, latitude, and longitude.

## Performance Optimization

- Caching : The live search results are cached to reduce database load and improve performance.
- Chunking : Data from the API is processed in chunks to manage memory usage effectively and optimize database operations.
- Bulk Upserts : The upsert method is used to handle large batches of data, reducing the number of database queries.
