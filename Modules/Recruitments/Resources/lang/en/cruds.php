<?php

return [
    'userManagement' => [
        'title' => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title' => 'Permissions',
        'title_singular' => 'Permission',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title' => 'Roles',
        'title_singular' => 'Role',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'permissions' => 'Permissions',
            'permissions_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'user' => [
        'title' => 'Users',
        'title_singular' => 'User',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'first_name' => 'First Name',
            'first_name_helper' => ' ',
            'last_name' => 'Last Name',
            'last_name_helper' => ' ',
            'gender' => 'Gender',
            'gender_helper' => ' ',
            'coy_no' => 'Coy No',
            'coy_no_helper' => ' ',
            'email' => 'Email',
            'email_helper' => ' ',
            'username' => 'Username',
            'username_helper' => ' ',
            'phone_no' => 'Phone No',
            'phone_no_helper' => ' ',
            'department' => 'Department',
            'department_helper' => ' ',
            'job' => 'Job',
            'job_helper' => ' ',
            'position' => 'Position',
            'position_helper' => ' ',
            'salary_scale' => 'Salary Scale',
            'salary_scale_helper' => ' ',
            'report_to' => 'Report To',
            'report_to_helper' => ' ',
            'is_locked' => 'Blocked',
            'active' => 'Active',
            'perdiem' => 'Perdiem',
            'perdiem_helper' => ' ',
            'email_verified_at' => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password' => 'Password',
            'password_helper' => ' ',
            'roles' => 'Roles',
            'roles_helper' => ' ',
            'remember_token' => 'Remember Token',
            'remember_token_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'loan_applicant'=>'Applicant Name',
            'loan_applicant_helper'=>'',

        ],
    ],
    
     
    'plot' => [
        'title' => 'Plots',
        'title_singular' => 'Plot',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'description' => 'Description',
            'description_helper' => ' ',
            'subject_id' => 'Subject ID',
            'subject_id_helper' => ' ',
            'subject_type' => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id' => 'User ID',
            'user_id_helper' => ' ',
            'customer' => 'Customer Name',
            'customer_helper' => ' ',
            'payment' => 'Payment Type',
            'payment_helper' => ' ',
            'project' => 'Project Name',
            'project_helper' => ' ',
            'marketing_officer' => 'Marketing Officer Name',
            'marketing_officer_helper' => ' ',
            'host' => 'Host',
            'host_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'is_cash_payment'=>'Click if the payment is CASH...',
            'is_cash_payment_helper'=> ''
        ],
    ],

    'auditLog' => [
        'title' => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'description' => 'Description',
            'description_helper' => ' ',
            'subject_id' => 'Subject ID',
            'subject_id_helper' => ' ',
            'subject_type' => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id' => 'User ID',
            'user_id_helper' => ' ',
            'properties' => 'Properties',
            'properties_helper' => ' ',
            'host' => 'Host',
            'host_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],


    'applicationRequest' => [
        'title' => 'Safari Requests',
        'title_singular' => 'Safari Request',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'user' => 'User',
            'user_helper' => ' ',
            'number' => 'Number',
            'number_helper' => ' ',
            'phone_no' => 'Mobile Number',
            'phone_no_helper' => ' ',
            'transport_medium' => 'Transport Medium',
            'transport_medium_helper' => ' ',
            'status' => 'Status',
            'status_helper' => ' ',
            'regions' => 'Safari To', // Regions
            'regions_from' => 'Safari From', // Regions
            'regions_helper' => ' ',
            'nights' => 'Nights',
            'nights_helper' => ' ',
            'incidential' => 'Incidential Allowance',
            'incidential_helper' => ' ',
            'in_transit' => 'In Transit',
            'in_transit_helper' => ' ',
            'night_child' => 'Night Child',
            'night_child_helper' => ' ',
            'half_per_diem' => 'Half Per Diem',
            'half_per_diem_helper' => ' ',
            'bus_fare' => 'Bus Fare',
            'total_amount' => 'Total Amount',
            'bus_fare_helper' => ' ',
            'cab_fare' => 'Cab Fare',
            'cab_fare_helper' => ' ',
            'started_at' => 'Start Date',
            'started_at_helper' => ' ',
            'ended_at' => 'End Date',
            'ended_at_helper' => ' ',
            'reason' => 'Reason',
            'reason_helper' => ' ',
            'description' => 'Description',
            'segment_id' => 'Segment ID',
            'segment_code' => 'Segment Code',
            'segment' => 'Segment',
            'segment_helper' => ' ',
            'segment_t_balance' => 'Segment Total Balance',
            'segment_t_balance_helper' => '',
            'gfs_code' => 'Gfs Code',
            'gfs_code_helper' => ' ',
            'gfs_budget' => 'GFS Budget',
            'gfs_budget_helper' => ' ',
            'gfs_utilised' => 'GFS Utilised',
            'gfs_utilised_helper' => '',
            'gfs_balance' => 'GFS Balance',
            'gfs_balance_helper' => ' ',
            'total_amount' => 'Total Amount to be Paid',
            'total_amount_helper' => ' ',
            'post_payment' => 'Posted Amount',
            'post_payment_helper' => ' ',
            'is_processed' => 'Is Processed',
            'is_processed_helper' => ' ',
            'created_by' => 'Created By',
            'created_by_helper' => ' ',
            'approved_by' => 'Approved By',
            'approved_by_helper' => ' ',
            'transaction_no' => 'Transaction No',
            'transaction_no_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'attachments' => 'Attachments',
            'attachments_helper' => ' ',
        ],
    ],

    'logRequest' => [
        'title' => 'Log Requests',
        'title_singular' => 'Log Request',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'safari_no' => 'Safari No',
            'request_nights' => 'Request Nights',
            'safari_to' => 'Safari To',
            'safari_reason' => 'Safari Reason',
            'safari_nights' => 'Safari Nights',
            'safari_helper' => ' ',
            'user' => 'Remarked By',
            'user_helper' => ' ',
            'remarks' => 'Remarks',
            'remarks_helper' => ' ',
            'description' => 'Description',
            'description_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'createdBy' => 'Requestor ',
            'createdBy_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],

    'status' => [
        'title' => 'Statuses',
        'title_singular' => 'Status',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'added_by' => 'Added by',
            'user_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],

    'projects' => [
        'title' => 'Projects',
        'title_singular' => 'Project',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Project Name',
            'name_helper' => ' ',
            'code' => 'project Code',
            'code_helper' => ' ',
            'site' => ' Project Site',
            'site_helper' => ' ',
            'license' => 'Project License',
            'license_helper' => ' ',
            'description' => 'Project Description',
            'description_helper' => ' ',
            'added_by' => 'Added by',
            'user_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'requestApproval' => [
        'title' => 'Request Approvals',
        'title_singular' => 'Request Approval',
        'short_title' => 'Req Approvals',
        'fields' => [
            'approve' => 'Approve',
            'approve_helper' => ' ',
            'remarks' => 'Remarks',
            'remarks_helper' => ' ',
            'selectApproval' => 'Select Approval',
            'approval' => 'Approval',
            'approval_lowercase' => 'approval',
            'accept' => 'Accept',
            'deny' => 'Deny',
        ],
    ],

    'category' => [
        'title' => 'Categories',
        'title_singular' => 'Category',
        'fields' => [
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Category Name',
            'name_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'created_by' => 'Created by',
            'created_by_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],

    ],



];
