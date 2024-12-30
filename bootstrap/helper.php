<?php

function lorem()
{
    return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
}

function lorem_title()
{
    return 'Lorem ipsum dolor sit amet';
}

function lorem_paragraph()
{
    return 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit amet consectetur adipisci[ng] velit, sed quia non numquam [do] eius modi tempora inci[di]dunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum[d] exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? [D]Quis autem vel eum i[r]ure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?';
}

/**
 * Checks if currently logged user is a Root user
 */
function isRoot(): bool
{
    return auth()->user()->hasRole('root');
}

function ajax(): App\Facades\Http\ResponseAjax
{
    return new App\Facades\Http\ResponseAjax();
}

function current_theme(): string
{
    $theme = app(App\Settings\GeneralSettings::class)->theme;
    $user = auth()->user();
    if($user){
        $userTheme = $user->preferences->theme;
        if($userTheme && $userTheme !== $theme && $userTheme !== 'auto'){
            $theme = $userTheme;
        }
    }
    $available = App\Lib\Theme::getAvailable();

    if($available->contains($theme) === false){
        $theme = $available->first();
    }

    return $theme;
}

function development(): bool
{
    return config('app.env') === 'development';
}

function production(): bool
{
    return config('app.env') === 'production';
}
