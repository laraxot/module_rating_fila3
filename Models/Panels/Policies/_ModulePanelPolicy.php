<?php
declare(strict_types=1);
namespace Modules\Rating\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Rating\Models\Panels\Policies\_ModulePanelPolicy as Panel;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class _ModulePanelPolicy extends XotBasePanelPolicy {
}
