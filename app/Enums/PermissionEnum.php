<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // General Permissions
    case VIEW_DASHBOARD = 'VIEW DASHBOARD';

    // Language Permissions
    case VIEW_ANY_LANGUAGES = 'VIEW ANY LANGUAGES';
    case VIEW_LANGUAGE = 'VIEW LANGUAGE';
    case CREATE_LANGUAGE = 'CREATE LANGUAGE';
    case UPDATE_LANGUAGE = 'UPDATE LANGUAGE';
    case DELETE_LANGUAGE = 'DELETE LANGUAGE';
    case RESTORE_LANGUAGE = 'RESTORE LANGUAGE';
    case FORCE_DELETE_LANGUAGE = 'FORCE DELETE LANGUAGE';

    // Classification Permissions
    case VIEW_ANY_CLASSIFICATIONS = 'VIEW ANY CLASSIFICATIONS';
    case VIEW_CLASSIFICATION = 'VIEW CLASSIFICATION';
    case CREATE_CLASSIFICATION = 'CREATE CLASSIFICATION';
    case UPDATE_CLASSIFICATION = 'UPDATE CLASSIFICATION';
    case DELETE_CLASSIFICATION = 'DELETE CLASSIFICATION';
    case IMPORT_CLASSIFICATION = 'IMPORT CLASSIFICATION';
    case EXPORT_CLASSIFICATION = 'EXPORT CLASSIFICATION';
    case RESTORE_CLASSIFICATION = 'RESTORE CLASSIFICATION';
    case FORCE_DELETE_CLASSIFICATION = 'FORCE DELETE CLASSIFICATION';

    // Movie Permissions
    case VIEW_ANY_MOVIES = 'VIEW ANY MOVIES';
    case VIEW_MOVIE = 'VIEW MOVIE';
    case CREATE_MOVIE = 'CREATE MOVIE';
    case UPDATE_MOVIE = 'UPDATE MOVIE';
    case DELETE_MOVIE = 'DELETE MOVIE';
    case IMPORT_MOVIE = 'IMPORT MOVIE';
    case EXPORT_MOVIE = 'EXPORT MOVIE';
    case RESTORE_MOVIE = 'RESTORE MOVIE';
    case FORCE_DELETE_MOVIE = 'FORCE DELETE MOVIE';

    // Country Permissions
    case VIEW_ANY_COUNTRIES     = 'VIEW ANY COUNTRIES';
    case VIEW_COUNTRY           = 'VIEW COUNTRY';
    case CREATE_COUNTRY         = 'CREATE COUNTRY';
    case UPDATE_COUNTRY         = 'UPDATE COUNTRY';
    case DELETE_COUNTRY         = 'DELETE COUNTRY';
    case IMPORT_COUNTRY         = 'IMPORT COUNTRY';
    case EXPORT_COUNTRY         = 'EXPORT COUNTRY';
    case RESTORE_COUNTRY        = 'RESTORE COUNTRY';
    case FORCE_DELETE_COUNTRY   = 'FORCE DELETE COUNTRY';

     // HallType Permissions
     case VIEW_ANY_HALLTYPE    = 'VIEW ANY HALLTYPE';
     case VIEW_HALLTYPE         = 'VIEW HALLTYPE';
     case CREATE_HALLTYPE         = 'CREATE HALLTYPE';
     case UPDATE_HALLTYPE         = 'UPDATE HALLTYPE';
     case DELETE_HALLTYPE         = 'DELETE HALLTYPE';
     case IMPORT_HALLTYPE         = 'IMPORT HALLTYPE';
     case EXPORT_HALLTYPE         = 'EXPORT HALLTYPE';
     case RESTORE_HALLTYPE        = 'RESTORE HALLTYPE';
     case FORCE_DELETE_HALLTYPE  = 'FORCE DELETE HALLTYPE';

    // SCREENTYPE Permissions
    case VIEW_ANY_SCREENTYPES    = 'VIEW ANY SCREENTYPES';
    case VIEW_SCREENTYPE         = 'VIEW SCREENTYPE';
    case CREATE_SCREENTYPE         = 'CREATE SCREENTYPE';
    case UPDATE_SCREENTYPE         = 'UPDATE SCREENTYPE';
    case DELETE_SCREENTYPE         = 'DELETE SCREENTYPE';
    case IMPORT_SCREENTYPE         = 'IMPORT SCREENTYPE';
    case EXPORT_SCREENTYPE         = 'EXPORT SCREENTYPE';
    case RESTORE_SCREENTYPE        = 'RESTORE SCREENTYPE';
    case FORCE_DELETE_SCREENTYPE  = 'FORCE DELETE SCREENTYPE';

     // Genre Permissions
     case VIEW_ANY_GENRES = 'VIEW ANY GENRES';
     case VIEW_GENRE = 'VIEW GENRE';
     case CREATE_GENRE = 'CREATE GENRE';
     case UPDATE_GENRE = 'UPDATE GENRE';
     case DELETE_GENRE = 'DELETE GENRE';
     case IMPORT_GENRE = 'IMPORT GENRE';
     case EXPORT_GENRE = 'EXPORT GENRE';
     case RESTORE_GENRE = 'RESTORE GENRE';
     case FORCE_DELETE_GENRE = 'FORCE DELETE GENRE';
}
