# Syndra

[![Build Status](https://travis-ci.org/laravelista/Syndra.svg?branch=1.0.0)](https://travis-ci.org/laravelista/Syndra) [![Latest Stable Version](https://poser.pugx.org/laravelista/syndra/v/stable)](https://packagist.org/packages/laravelista/syndra) [![Total Downloads](https://poser.pugx.org/laravelista/syndra/downloads)](https://packagist.org/packages/laravelista/syndra) [![Latest Unstable Version](https://poser.pugx.org/laravelista/syndra/v/unstable)](https://packagist.org/packages/laravelista/syndra) [![License](https://poser.pugx.org/laravelista/syndra/license)](https://packagist.org/packages/laravelista/syndra)

Common JSON responses for an API built with Laravel 5.2.

> This package was inspired by a series from Laracasts [Incremental APIs](https://laracasts.com/series/incremental-api-development).

## Preface

I've built this package out of necessity. At the same time I was coding 3 similar APIs and have found a repeating pattern while doing so. I would create a Controller named `ApiController` and then extend that controller. The code in `ApiController` was mostly aimed at returning responses.
 
*I wanted to have generic JSON responses for when a resource was created, updated, destroyed, indexed, shown etc.*
 
My first thought was that I can just create a package out of that `ApiController` and be done with it, but I soon realized that I also wanted to be able to use those responses in other parts of the application, not just in controllers. You could have a global exception catcher for when the model is not found or if the validation fails. **Wouldn't  it  be nice if you could use the same responses everywhere.**
 
Then I tried writing the package as a trait. I read somewhere that traits are meant  to be stateless so I quickly abandoned that approach. And then it hit me. Why not just write a simple class that can be  easily extended :) 

This is the story how *Syndra was created.*  
 
**Thanks for reading.**
 
## Features
 
You are probably interested in what this package can do:
 
 - It returns generic *(predefined)* JSON responses for common API actions like creating, updating, destroying, indexing and showing a resource
 - It can be easily extended and modified
 - It can be used anywhere in your application *(controllers, routes etc...)*
 - It has 100% code coverage with PHPUnit
 - It comes Laravel 5.2 ready and with a Facade `Syndra` for easy use

## Documentation

See [wiki](https://github.com/laravelista/Syndra/wiki) for documenation.
