<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Accueil', route('dashboard'));
});

Breadcrumbs::for('employers.index', function (BreadcrumbTrail $trail) {
	$trail->parent('dashboard');
	$trail->push('Employers', route('employers.index'));
});
Breadcrumbs::for('employers.create', function (BreadcrumbTrail $trail) {
	$trail->parent('employers.index');
	$trail->push('Ajouter', route('employers.create'));
});
/*
Breadcrumbs::for('employers.show', function (BreadcrumbTrail $trail, $employer) {
	$trail->parent('employers.show');
	$trail->push($employer->name, route('employers.index'));
});
Breadcrumbs::for('employers.edit', function (BreadcrumbTrail $trail, $employer) {
	$trail->parent('employers.show', $employer);
	$trail->push('Editer', route('employers.edit'));
});*/