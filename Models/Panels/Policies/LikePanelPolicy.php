<?php
namespace Modules\Rating\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Rating\Models\Panels\Policies\LikePanelPolicy as Panel;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class LikePanelPolicy extends XotBasePanelPolicy {
}
