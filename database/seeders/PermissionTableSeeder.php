<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$permissions = [
'Invoices',
'List Of Invoices',
'Paid Invoices',
'Partial Invoices',
'Unpaid Invoices',
'Archive Invoices',
'Reports',
'Reports of Invoices',
'Reports of User',
'Users',
'List of Users',
'Powers of Users',
'Settings',
'Department',
'Category',

'Add Of Invoice',
'export Excel',
'edit',
'delete',
'status payment',
'invoices archive',
'add archive',
'delete archive',

'add user',
'edit user',
'delete user',

'show role',
'add role',
'edit role',
'delete role',

'add product',
'edit product',
'delete product',

'add section',
'edit section',
'delete section',
'notification'



];
foreach ($permissions as $permission) {
Permission::create(['name' => $permission]);
}
}
}