<?php

namespace App\Providers\Filament;


use Filament\Auth\MultiFactor\App\AppAuthentication;
use Filament\Auth\MultiFactor\Email\EmailAuthentication;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Pages\Tenancy\EditWorkspaceProfile;
use App\Filament\Pages\Tenancy\RegisterWorkspace;
use App\Models\Workspace;

use App\Filament\Pages\Settings;
use App\Http\Middleware\ApplyTenantScopes;
use Filament\Actions\Action;

class V1PanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('v1')
            ->path('v1')
            ->login()
            ->profile()
            ->brandName('Zeckta')
            ->brandLogo(asset('images/zeckta-logo.svg'))
            ->favicon(asset('favicon.ico'))
            ->font('Poppins')
            ->navigationItems([
                NavigationItem::make('Support & Help')
                    ->url('https://support.zeckta.com')
                    ->label('Support & Help')
                    ->icon('heroicon-o-question-mark-circle')
                    ->group('Support')
                    ->sort(10),
                NavigationItem::make('Feedback')
                    ->url('https://support.zeckta.com')
                    ->label('Feedback')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->group('Support')
                    ->sort(11)
            ])
            ->multiFactorAuthentication([
                EmailAuthentication::make(),
                AppAuthentication::make()
            ])
            ->registration()
            // ->topNavigation()
            ->colors([
                'primary' => Color::Blue,
                // 'gray' => Color::Slate,
                // 'danger' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->resourceCreatePageRedirect('index')
            ->resourceEditPageRedirect('index')
            ->authMiddleware([
                Authenticate::class,
            ])
            ->passwordReset()
            ->emailVerification()
            ->emailChangeVerification()
            ->tenant(Workspace::class)
            ->tenantRegistration(RegisterWorkspace::class)
            ->tenantProfile(EditWorkspaceProfile::class)
            ->tenantMenuItems([
                Action::make('settings')
                    ->url(fn(): string => Settings::getUrl())
                    ->icon('heroicon-m-cog-8-tooth'),
                // ...
            ])
            ->searchableTenantMenu()
            ->tenantMenuItems([
                'register' => fn(Action $action) => $action->label('Add a new workspace'),
                // ...
            ])
            ->tenantMenuItems([
                'profile' => fn(Action $action) => $action->label('Edit Workspace'),
                // ...
            ])
            ->tenantMiddleware([
                ApplyTenantScopes::class,
            ], isPersistent: true)
            ->tenantRoutePrefix('workspace')

        ;
    }
}


/**Home
 * Messaging
 * Senders
 * Phonebook
 * Analtics
 * Billing
 * Delivery & Quality
 * Logs

 * 
 * </> Api Settings
 */
