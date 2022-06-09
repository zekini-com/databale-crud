  

  

# Introduction

  
The **zekini/datatable-crud** package allows us to generate datatable for a particular model in our database

 
## Installation

`composer require --dev zekini/datatable-crud`

  
## Setup

This package makes use of two additional packages 

[https://github.com/wire-elements/modal] Wire modal and [https://github.com/jantinnerezo/livewire-alert] which requires you to add the following to your `layouts.app` just after the livewire scripts
`
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <x-livewire-alert::scripts />
    @livewire('livewire-ui-modal')
`
## Usage

To generate a datatable

`php artisan admin:datatable`

This will generate both datatable, an import and export file for the table

## Relationships

For tables with foreign keys ensure publish the package config file and update the relationships array of the datatable crud config file

Eg for a post relationship belonging to users. where record title is the record you want to show from the foreign table

  

'posts'=> [

[

'name' => 'belongs_to',

'table'=> 'users',

'record_title'=> 'name'

]

]

  
  


  
