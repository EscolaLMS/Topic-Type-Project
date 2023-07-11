# Topic Type Project

[![swagger](https://img.shields.io/badge/documentation-swagger-green)](https://escolalms.github.io/Topic-Type-Project/)
[![codecov](https://codecov.io/gh/EscolaLMS/Topic-Type-Project/branch/main/graph/badge.svg?token=NRAN4R8AGZ)](https://codecov.io/gh/EscolaLMS/Topic-Type-Project)
[![phpunit](https://github.com/EscolaLMS/Topic-Type-Project/actions/workflows/test.yml/badge.svg)](https://github.com/EscolaLMS/Topic-Type-Project/actions/workflows/test.yml)
[![downloads](https://img.shields.io/packagist/dt/escolalms/topic-type-project)](https://packagist.org/packages/escolalms/topic-type-project)
[![downloads](https://img.shields.io/packagist/v/escolalms/topic-type-project)](https://packagist.org/packages/escolalms/topic-type-project)
[![downloads](https://img.shields.io/packagist/l/escolalms/topic-type-project)](https://packagist.org/packages/escolalms/topic-type-project)
[![Maintainability](https://api.codeclimate.com/v1/badges/0c9e2593fb30e2048f95/maintainability)](https://codeclimate.com/github/EscolaLMS/Topic-Type-Project/maintainability)

## What does it do

This package is another [TopicType](https://github.com/EscolaLMS/topic-types). It allows students to upload their solutions as files.
This type is used for building headless Course.

When creating course content in the Admin Panel, you can create a topic of type "Project." During the course, students can upload files with their solutions.
There is a tab in the Admin Panel to preview students' solutions.

## Installing

- `composer require escolalms/topic-type-project`
- `php artisan migrate`
- `php artisan db:seed --class="https://github.com/EscolaLMS/Topic-Type-Project/blob/main/database/seeders/TopicTypeProjectPermissionSeeder.php"`

## Endpoints

The endpoints are defined in [![swagger](https://img.shields.io/badge/documentation-swagger-green)](https://escolalms.github.io/Topic-Type-Project/)

## Tests

Run `./vendor/bin/phpunit` to run tests.
Test details [![codecov](https://codecov.io/gh/EscolaLMS/Topic-Type-Project/branch/main/graph/badge.svg?token=NRAN4R8AGZ)](https://codecov.io/gh/EscolaLMS/Topic-Type-Project)

## Events

- `ProjectSolutionCreatedEvent` - This event is dispatched when the user has uploaded a solution

You can use the [escolalms/templates-email](https://github.com/EscolaLMS/Templates-Email/tree/main/src/TopicTypeProject) package, which listens to this event and sends an email.

## Listeners

This package does not listen for any events.

## Permissions

Permissions are defined in [seeder](https://github.com/EscolaLMS/Topic-Type-Project/blob/main/database/seeders/TopicTypeProjectPermissionSeeder.php).
