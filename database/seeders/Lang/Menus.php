<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Menus extends Seeder
{
    public static function list(): array
    {
        return array(
            'dashboard' => array(
                'pl' => 'Pulpit',
                'en' => 'Dashboard',
            ),
            'admin_panel' => array(
                'pl' => 'Panel administracyjny',
                'en' => 'Admin panel',
            ),
            'reports.index' => array(
                'pl' => 'Raporty',
                'en' => 'Reports',
            ),
            'notifications.index' => array(
                'pl' => 'Powiadomienia',
                'en' => 'Notifications',
            ),
            'edit_profile' => array(
                'pl' => 'Edytuj profil',
                'en' => 'Edit profile',
            ),
            'activity' => array(
                'pl' => 'Aktywność',
                'en' => 'Activity',
            ),
            'my_results' => array(
                'pl' => 'Moje wyniki',
                'en' => 'My results',
            ),
            'preferences' => array(
                'pl' => 'Preferencje',
                'en' => 'Preferences',
            ),
            'logout' => array(
                'pl' => 'Wyloguj',
                'en' => 'Logout',
            ),
            'login' => array(
                'pl' => 'Zaloguj się',
                'en' => 'Login',
            ),
            'forgot_password' => array(
                'pl' => 'Przypomnij hasło',
                'en' => 'Forgot password',
            ),
            'remember_me' => array(
                'pl' => 'Zapamiętaj mnie',
                'en' => 'Remember me',
            ),
            'impersonation_leave' => array(
                'pl' => 'Wyloguj się jako',
                'en' => 'Logout as',
            ),
            'impersonated_by' => array(
                'pl' => ':name podszywa się',
                'en' => ':name impersonated',
            ),
            'my_objectives.index' => array(
                'pl' => 'Moje cele',
                'en' => 'My objectives',
            ),
            'profile.index' => array(
                'pl' => 'Profil',
                'en' => 'Profile',
            ),
            'profile.edit' => array(
                'pl' => 'Edytuj',
                'en' => 'Edit',
            ),
            'profile.reset' => array(
                'pl' => 'Reset hasła',
                'en' => 'Reset password',
            ),
            'profile.personal_data' => array(
                'pl' => 'Dane personalne',
                'en' => 'Personal data',
            ),
            'profile.settings' => array(
                'pl' => 'Ustawienia konta',
                'en' => 'Account settings',
            ),
            'profile.logs' => array(
                'pl' => 'Twoja aktywność',
                'en' => 'Your activity',
            ),
            'settings.index' => array(
                'pl' => 'Ustawienia',
                'en' => 'Settings',
            ),
            'settings.general.index' => array(
                'pl' => 'Główne',
                'en' => 'General',
            ),
            'settings.modules.index' => array(
                'pl' => 'Moduły',
                'en' => 'Modules',
            ),
            'settings.integrations.index' => array(
                'pl' => 'Integracje',
                'en' => 'Integrations',
            ),
            'settings.notifications.index' => array(
                'pl' => 'Powiadomienia',
                'en' => 'Notifications',
            ),
            'settings.server.index' => array(
                'pl' => 'Serwer',
                'en' => 'Server',
            ),
            'settings.logs.index' => array(
                'pl' => 'Logi',
                'en' => 'Logs',
            ),
            'settings.help.index' => array(
                'pl' => 'Pomoc',
                'en' => 'Help',
            ),
            'settings.organization.index' => array(
                'pl' => 'Struktura organizacyjna',
                'en' => 'Organization structure',
            ),
            'settings.organization.companies.index' => array(
                'pl' => 'Przedsiębiorstwa',
                'en' => 'Companies',
            ),
            'settings.organization.departments.index' => array(
                'pl' => 'Działy',
                'en' => 'Departments',
            ),
            'settings.organization.positions.index' => array(
                'pl' => 'Stanowiska',
                'en' => 'Positions',
            ),
            'settings.organization.contracts.index' => array(
                'pl' => 'Typy kontraktów',
                'en' => 'Contract types',
            ),
            'settings.creator.index' => array(
                'pl' => 'Kreator struktury',
                'en' => 'Creator structure',
            ),
            'settings.teams.index' => array(
                'pl' => 'Zespoły',
                'en' => 'Teams',
            ),
            'mbo.index' => array(
                'pl' => 'Zarządzanie celami',
                'en' => 'Manage objectives',
            ),
            'objectives.index' => array(
                'pl' => 'Cele',
                'en' => 'Objectives',
            ),
            'objectives.create' => array(
                'pl' => 'Tworzenie celu',
                'en' => 'Create objective',
            ),
            'objectives.edit' => array(
                'pl' => 'Modyfikacja celu',
                'en' => 'Edit objective',
            ),
            'templates.index' => array(
                'pl' => 'Szablony celów',
                'en' => 'Objective templates',
            ),
            'templates.create' => array(
                'pl' => 'Tworzenie szablonu celu',
                'en' => 'Create objective template',
            ),
            'templates.edit' => array(
                'pl' => 'Modyfikacja szablonu celu',
                'en' => 'Edit objective template',
            ),
            'categories.index' => array(
                'pl' => 'Kategorie celów',
                'en' => 'Objective categories',
            ),
            'categories.create' => array(
                'pl' => 'Tworzenie kategorii MBO',
                'en' => 'Create objective category',
            ),
            'categories.edit' => array(
                'pl' => 'Modyfikacja kategorii MBO',
                'en' => 'Edit objective category',
            ),
            'campaigns.index' => array(
                'pl' => 'Kampanie Pomiarowe',
                'en' => 'Campaigns',
            ),
            'campaigns.create' => array(
                'pl' => 'Tworzenie nowej kampanii pomiarowej',
                'en' => 'Create campaign',
            ),
            'campaigns.edit' => array(
                'pl' => 'Edycja kampanii',
                'en' => 'Edit campaign',
            ),
            'users.index' => array(
                'pl' => 'Użytkownicy',
                'en' => 'Users',
            ),
            'users.edit' => array(
                'pl' => 'Edycja użytkownika',
                'en' => 'Edit user',
            ),
            'users.create' => array(
                'pl' => 'Tworzenie użytkownika',
                'en' => 'Create user',
            ),
            'users.show' => array(
                'pl' => 'Profil użytkownika',
                'en' => 'User profile',
            ),
            'info.profile.logs' => array(
                'pl' => 'Strona przedstawia całą Twoją aktywność, jaka jest mierzona przez system.',
                'en' => 'This page displays your entire activity, which is monitored by the system.',
            ),
        );
    }
}
