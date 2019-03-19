<?php

 

    // Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', '/');
});

// Home > contacto
Breadcrumbs::for('contacto', function ($trail) {
    $trail->parent('home');
    $trail->push('Contacto', '/contacto');
});




// Home > cotizador
Breadcrumbs::for('cotizador', function ($trail) {
    $trail->parent('home');
    $trail->push('Cotizador', '/cotizador');
});


// Home > sucursales
Breadcrumbs::for('sucursales', function ($trail) {
    $trail->parent('home');
    $trail->push('Sucursales', '/sucursales');
});




    

 

// Home > [Category] > [Product]
Breadcrumbs::for('product', function ($trail, $product) {
    $trail->parent('home');
    $trail->push($product->name, $product->slug);
});

