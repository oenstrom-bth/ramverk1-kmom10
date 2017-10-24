<div class="profile-grid">
    <div class="card marg-bot-half">
        <h2 class="hug">Your Profile</h2>
        <?= $gravatar ?>
        <h3 class="hug">@<?= $user->username ?></h3>
        <div class="form-wrapper child">
            <?= $form ?>
        </div>
    </div>

    <div class="card marg-bot-half">
        <h2 class="hug">Links</h2>
        <ul>
            <li><a href="<?= $this->url("questions/ask") ?>">Ask Question</a></li>
            <li><a href="<?= $this->url("users/{$user->username}") ?>">Your Activity</a></li>
            <li>
                <a href="<?= $this->url("user/logout") ?>">
                    <span>Logga ut</span>
                </a>
            </li>
        </ul>
    </div>
</div>
