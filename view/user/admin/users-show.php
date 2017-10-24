<div class="card">
    <h2 class="hug">All users</h2>
    <div class="responsive-table">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Authority</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td class="">
                        <a href="<?= $this->url("user/admin/users/update/{$user->id}") ?>"><i class="fa fa-edit"></i></a>
                        <a href="<?= $this->url("user/admin/users/delete/{$user->id}") ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></a>
                    </td>
                    <td><?= $user->role ?></td>
                    <td><?= $user->username ?></code></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->created ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
