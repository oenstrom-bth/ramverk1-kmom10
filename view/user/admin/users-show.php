<div class="mdl-cell mdl-cell--12-col mdl-cell--10-col-desktop mdl-cell--1-offset-desktop mdl-shadow--2dp padd-10">
    <div class="responsive-table-wrapper">
        <h1>Alla användare</h1>
        <div class="responsive-table">
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell-non-numeric"></th>
                        <th class="mdl-data-table__cell--non-numeric">Behörighet</th>
                        <th class="mdl-data-table__cell--non-numeric">Användarnamn</th>
                        <th class="mdl-data-table__cell--non-numeric">E-post</th>
                        <th class="mdl-data-table__cell--non-numeric">Skapad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">
                            <a href="<?= $this->url("user/admin/users/update/{$user->id}") ?>"><i class="material-icons">edit</i></a>
                            <a href="<?= $this->url("user/admin/users/delete/{$user->id}") ?>" onclick="return confirm('Är du säker?')"><i class="material-icons">delete</i></a>
                        </td>
                        <td class="mdl-data-table__cell--non-numeric"><?= $user->role ?></td>
                        <td class="mdl-data-table__cell--non-numeric"><?= $user->username ?></code></td>
                        <td class="mdl-data-table__cell--non-numeric"><?= $user->email ?></td>
                        <td class="mdl-data-table__cell--non-numeric"><?= $user->created ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
