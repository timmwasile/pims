<?php

namespace app\bootstrap;

use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Project;
use Modules\Admins\Entities\Company;
use Modules\Recruitments\Entities\Transaction;

/**
 *  Application number generator using month/year/job_id/app_name and
 * serial number.
 *
 * @param  string  $type  Type
 * @param  int     $id    ID
 *
 * @return string
 */
function randGenerator(string $type, int $id): string
{
    $starter = date('my');
    $end = str_pad($id, 4, '0', STR_PAD_LEFT);

    switch (strtolower($type)) {
        case 'EmployeeRegistration':
            return strtoupper('PGL-' . $end);

            break;

        default:
            return strtoupper('PGL-' . $end);

            break;
    }
}

/**
 *  plot number generator using project/month/year/office Name and
 * serial number.
 *
 * @param  string  $type  Type
 * @param  int     $id    ID
 *
 * @return string
 */
function plotNumber(string $type, int $id): string
{
    $plot_details = Plot::where('id',$id)->first();
    $project=Project::where('id',$plot_details->project_id)->first();
    $company=Company::where('id',$plot_details->company_id)->first()->name;
    $starter = str_pad($project->id, 3, '0', STR_PAD_LEFT). substr(strtoupper($project->initial), 0, 3);
    $end = str_pad($id, 4, '0', STR_PAD_LEFT);


    switch (strtolower($type)) {
        case 'plot_number':
            return strtoupper($starter .'-'.substr($company,0,3).'-P-'. $end);

            break;

        default:
            return strtoupper($starter .'-'.substr($company,0,3).'-P-'. $end);

            break;
    }
}


/**
 *  Transaction number generator using project/month/year/office Name and
 * serial number.
 *
 * @param  string  $type  Type
 * @param  int     $id    ID
 *
 * @return string
 */
function transactionNumber(string $type, int $id): string
{
   $starter = date('my');
    $end = str_pad($id, 4, '0', STR_PAD_LEFT);
    $transaction=Transaction::where('id',$id)->first()->company_id;
    $company=Company::where('id',$transaction)->first()->name;

    switch (strtolower($type)) {
        case 'transaction_number':
            return strtoupper($starter .'-'.substr($company,0,3).'-TR-' . $end);
            break;

        default:
            return strtoupper($starter .'-'.substr($company,0,3).'-TR-' . $end);
            break;
    }
}