<?php

declare (strict_types = 1);

namespace Larke\Admin\Command;

use Illuminate\Console\Command;

use Larke\Admin\Model\Admin as AdminModel;

/**
 * 重置密码
 *
 * > php artisan larke-admin:reset-password
 *
 * @create 2021-1-25
 * @author deatil
 */
class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larke-admin:reset-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'larke-admin reset-password';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        askForAdminName:
        $name = $this->ask('Please enter an adminName who needs to reset his password');
        
        $admin = AdminModel::query()
            ->where('name', $name)
            ->first();
        if (is_null($admin)) {
            $this->line("<error>The admin who you entered is not exists !</error> ");
            goto askForAdminName;
        }
        
        $newPassword = $this->secret('Please enter a password, not enter wiil rand make a new password');
        if (empty($newPassword)) {
            $newPassword = mt_rand(10000000, 99999999);
        }
        
        // 新密码
        $newPasswordInfo = AdminModel::makePassword(md5($newPassword)); 

        // 更新信息
        $status = $admin->update([
                'password' => $newPasswordInfo['password'],
                'password_salt' => $newPasswordInfo['encrypt'],
            ]);
        if ($status === false) {
            $this->line("<error>Reset password is error !</error> ");
            return;
        }
        
        $this->line("<info>Admin'newpassword is:</info> ".$newPassword);
    }
}
