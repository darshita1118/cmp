<?php

namespace App\Helpers;

use App\Models\ApplicationModel;
use CodeIgniter\Database\BaseBuilder;

function handlerStatusReport($year = '2023', $priffix = 'cmp_2_', $suffix = '2021_25', $handlerId = false, $status)
{
    $selectedLeads = [];
    if ($handlerId) {
        $allocatedModel = new ApplicationModel('lead_allocation_' . $year, 'lal_id', $priffix . $suffix);
        $selectedLeads = $allocatedModel->select(['lead_id'])->where('handler_id', $handlerId)->findAll() ?? [];
        $selectedLeads = array_column($selectedLeads, 'lead_id');
    }
    $data = [];
    if ($selectedLeads) {
        $leadModel = new ApplicationModel('lead_profile_' . $year, 'lid', $priffix . $suffix);
        $data['today'] = $leadModel->where('lead_status', $status)->join('lead_status_' . $year, 'lead_profile_' . $year . '.lid=lead_status_' . $year . '.lead_id')->where(['ls_date' => date('Y-m-d'), 'lead_delete_status' => 0])->whereIn('lid',  $selectedLeads)->countAllResults();
        $data['overdue'] = $leadModel->where('lead_status', $status)->join('lead_status_' . $year, 'lead_profile_' . $year . '.lid=lead_status_' . $year . '.lead_id')->where(['ls_date<' => date('Y-m-d'), 'lead_delete_status' => 0])->whereIn('lid',  $selectedLeads)->countAllResults();
    }
    return $data;
}
function handlerReportStatusWise($year = '2023', $priffix = 'cmp_2_', $suffix = '2021_25', $handlerId = false)
{
    $leadModel = new ApplicationModel('status', 'status_id', $priffix . $suffix);
    $statusWise = $leadModel->select(['status_name name', 'status_get_more_info type', 'COUNT(lid) total_leads', 'status_id id'])->join('lead_profile_' . $year, 'status.status_id=lead_profile_' . $year . '.lead_status', 'left')->where('(lead_delete_status = 0 OR lead_delete_status is null)')->whereIn('lid',  function (BaseBuilder $builder) use ($handlerId, $year) {
        return $builder->select('lead_id')->from('lead_allocation_'.$year)->where(['handler_id' => $handlerId]);
    })->groupBy('status_id')->findAll() ?? [];
    return $statusWise;
}
