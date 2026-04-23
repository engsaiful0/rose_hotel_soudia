<?php

class ReportController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");

        $this->load->library("pagination");
        $user_id = $this->session->userdata('id');
        if ($user_id == '') {
            redirect(base_url() . 'login');
        }
    }
    public function details_report($project_id)
    {
        $data['project_id'] = $project_id;
        $data['output_content'] = $this->load->view('report/details_report', $data, true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function expense_report()
    {
        $data['output_content'] = $this->load->view('report/expense_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function monthly_checkinday_report()
    {
        $data['output_content'] = $this->load->view('report/monthly_checkinday_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function monthly_checkinday_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['hotel_id'] = $_POST['hotel_id'];
        $this->load->view('report/monthly_checkinday_report_load', $data);
    }
    public function monthly_expense_report()
    {
        $data['output_content'] = $this->load->view('report/monthly_expense_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function monthly_expense_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['hotel_id'] = $_POST['hotel_id'];
        $this->load->view('report/monthly_expense_report_load', $data);
    }
    public function checkinday_report()
    {
        $data['output_content'] = $this->load->view('report/checkinday_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function checkinmonth_report()
    {
        $data['output_content'] = $this->load->view('report/checkinmonth_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function checkinday_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['hotel_id'] = $_POST['hotel_id'];
        $data['day_or_month_or_year'] = $_POST['day_or_month_or_year'];
        $this->load->view('report/checkinday_report_load', $data);
    }

    public function credit_report()
    {
        $data['output_content'] = $this->load->view('report/credit_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }


    public function patient_report()
    {
        $data['output_content'] = $this->load->view('report/patient_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function admission_report()
    {
        $data['output_content'] = $this->load->view('report/admission_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function checkinmonth_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['hotel_id'] = $_POST['hotel_id'];
        $data['day_or_month_or_year'] = $_POST['day_or_month_or_year'];
        $this->load->view('report/checkinmonth_report_load', $data);
    }
    public function credit_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['hotel_id'] = $_POST['hotel_id'];
        $this->load->view('report/credit_report_load', $data);
    }


    public function patient_report_load()
    {

        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $this->load->view('report/patient_report_load', $data);
    }

    public function lobbeying_cost_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['lobbeying_cost_head_id'] = $ids[2];
        $data['project_id'] = $ids[3];
        $this->pdf->load_view('report/lobbeying_cost_report_load_pdf', $data);

        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[3])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Lobbbeying Cost Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Lobbbeying Cost Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        }
    }

    public function operation_cost_report()
    {
        $data['output_content'] = $this->load->view('report/operation_cost_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function operation_cost_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['admin_cost_head_id'] = $_POST['admin_cost_head_id'];
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/operation_cost_report_load', $data);
    }

    public function operation_cost_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['admin_cost_head_id'] = $ids[2];
        $data['project_id'] = $ids[3];
        $this->pdf->load_view('report/operation_cost_report_load_pdf', $data);

        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[3])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Operation Cost Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Operation Cost Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        }
    }

    public function salvage_cost_report()
    {
        $data['output_content'] = $this->load->view('report/salvage_cost_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function salvage_cost_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/salvage_cost_report_load', $data);
    }

    public function salvage_cost_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['project_id'] = $ids[2];
        $this->pdf->load_view('report/salvage_cost_report_load_pdf', $data);

        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[2])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Salvage Cost Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Salvage Cost Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');

        }
    }

    public function authority_cost_report()
    {
        $data['output_content'] = $this->load->view('report/authority_cost_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function authority_cost_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['office_cost_head_id'] = $_POST['office_cost_head_id'];
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/authority_cost_report_load', $data);
    }

    public function authority_cost_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['office_cost_head_id'] = $ids[2];
        $data['project_id'] = $ids[3];
        $this->pdf->load_view('report/authority_cost_report_load_pdf', $data);
        $this->pdf->render();
        if ($ids[3] != 'null') {
            $project = $this->db->where('project_id', $ids[3])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Authority Office Cost Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Authority Office Cost Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');

        }
    }

    public function labor_cost_report()
    {
        $data['output_content'] = $this->load->view('report/labor_cost_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function revised_price_report()
    {
        $data['output_content'] = $this->load->view('report/revised_price_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function revised_price_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/revised_price_report_load', $data);
    }

    public function revised_price_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['project_id'] = $ids[2];
        $this->pdf->load_view('report/revised_price_report_load_pdf', $data);

        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[2])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Revised Price Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Revised Price Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');

        }
    }

    public function project_wise_details_report()
    {
        $data['output_content'] = $this->load->view('report/project_wise_details_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function project_wise_details_report_load()
    {
        $data = array();
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/project_wise_details_report_load', $data);
    }

    public function material_purchase_report()
    {
        $data['output_content'] = $this->load->view('report/material_purchase_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function material_purchase_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['material_head_id'] = $_POST['material_head_id'];
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/material_purchase_report_load', $data);
    }

    public function material_purchase_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['material_head_id'] = $ids[2];
        $data['project_id'] = $ids[3];
        $this->pdf->load_view('report/material_purchase_report_load_pdf', $data);
        $this->pdf->render();
        if ($ids[3] != 'null') {
            $project = $this->db->where('project_id', $ids[3])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Material Purchase Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Material Purchase Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');

        }
    }

    public function lobor_cost_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['labor_cost_head_id'] = $_POST['labor_cost_head_id'];
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/lobor_cost_report_load', $data);
    }

    public function lobor_cost_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['labor_cost_head_id'] = $ids[2];
        $data['project_id'] = $ids[3];
        $this->pdf->load_view('report/lobor_cost_report_load_pdf', $data);
        $this->pdf->render();
        if ($ids[3] != 'null') {
            $project = $this->db->where('project_id', $ids[3])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Labor Cost Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Labor Cost Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');

        }
    }

    public function vat_tax_report()
    {
        $data['output_content'] = $this->load->view('report/vat_tax_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function vat_tax_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/vat_tax_report_load', $data);
    }

    public function vat_tax_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['project_id'] = $ids[2];
        $this->pdf->load_view('report/vat_tax_report_load_pdf', $data);

        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[2])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Vat & Tax Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Vat & Tax Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');

        }
    }



    public function security_money_report()
    {
        $data['output_content'] = $this->load->view('report/security_money_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function partial_project_bill_report()
    {
        $data['output_content'] = $this->load->view('report/partial_project_bill_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function partial_project_bill_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/partial_project_bill_report_load', $data);
    }

    public function partial_project_bill_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['project_id'] = $ids[2];
        $this->pdf->load_view('report/partial_project_bill_report_load_pdf', $data);
        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[2])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Partial Project Bill Report.pdf');
        } else {
            $this->pdf->stream('Partial Project Bill Report.pdf');

        }
    }


    public function cash_received_report()
    {
        $data['output_content'] = $this->load->view('report/cash_received_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function cash_received_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/cash_received_report_load', $data);
    }

    public function cash_received_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['project_id'] = $ids[2];
        $this->pdf->load_view('report/cash_received_report_load_pdf', $data);
        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[2])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Cash Received Report.pdf');
        } else {
            $this->pdf->stream('Cash Received Report.pdf');

        }
    }


    public function bill_received_report()
    {
        $data['output_content'] = $this->load->view('report/bill_received_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }
    public function bill_received_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/bill_received_report_load', $data);
    }

    public function bill_received_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['project_id'] = $ids[2];
        $this->pdf->load_view('report/bill_received_report_load', $data);
        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[2])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Bill Received Report.pdf');
        } else {
            $this->pdf->stream('Bill Received Report.pdf');

        }
    }

    public function security_moeny_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/security_moeny_report_load', $data);
    }

    public function security_money_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['project_id'] = $ids[2];
        $this->pdf->load_view('report/security_money_report_load_pdf', $data);
        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[2])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Security Money Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Security Money Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');

        }
    }

    public function other_cost_report()
    {
        $data['output_content'] = $this->load->view('report/other_cost_report', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);
    }

    public function other_cost_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['other_cost_head_id'] = $_POST['other_cost_head_id'];
        $data['project_id'] = $_POST['project_id'];
        $this->load->view('report/other_cost_report_load', $data);
    }

    public function other_cost_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
//        echo '<pre>';
//        var_dump($ids);
//        die;
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['other_cost_head_id'] = $ids[2];
        $data['project_id'] = $ids[3];

        $this->pdf->load_view('report/other_cost_report_load_pdf', $data);
        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[3])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Other Cost Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Other Cost Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');

        }
    }

    public function expense_report_load()
    {
        $data = array();
        $data['from_date'] = date('Y-m-d', strtotime($_POST['from_date']));
        $data['to_date'] = date('Y-m-d', strtotime($_POST['to_date']));
        $data['hotel_id'] = $_POST['hotel_id'];
        $this->load->view('report/expense_report_load', $data);
    }

    public function financial_cost_report_load_pdf($ids)
    {
        $ids = explode("_", $ids);
        $data = array();
        $data['from_date'] = $ids[0];
        $data['to_date'] = $ids[1];
        $data['financial_cost_head_id'] = $ids[2];
        $data['project_id'] = $ids[3];

        $this->pdf->load_view('report/financial_cost_report_load_pdf', $data);
        $this->pdf->render();
        if ($ids[2] != 'null') {
            $project = $this->db->where('project_id', $ids[3])->get('project')->row();
            $this->pdf->stream($project->project_name . 'Financial Cost Report From Date' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        } else {
            $this->pdf->stream('Financial Cost Report From Date_' . date('d-m-Y', strtotime($ids[0])) . '_To Date' . date('d-m-Y', strtotime($ids[1])) . '.pdf');
        }
    }

    public function view_purchase()
    {
        $config = array();
        $config["base_url"] = base_url() . "PurchaseController/view_purchase";
        $config["total_rows"] = $this->pagmodel->total_purchase();
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;
        $config['first_tag_open'] = '<div>';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</div>';

        $config['last_tag_open'] = '<div>';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</div>';

        $config['next_tag_open'] = '<div>';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</div>';

        $config['prev_tag_open'] = '<div>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $result["result"] = $this->pagmodel->
        get_purchase($config["per_page"], $page);
        $result["paginglinks"] = $this->pagination->create_links();

        $data = array();
        $data['flag'] = '';
        $data['output_content'] = $this->load->view('backend/view_purchase', $result, true);

        $this->load->view('admin_content', $data);
    }

    public function purchase_save()
    {
        $purchase_unique_id = $this->input->post('purchase_unique_id');
        $duplicate = $this->db->where('purchase_unique_id', $purchase_unique_id)->get('purchase')->result();
        if (count($duplicate) == 0) {
            $data = array();
            $data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
            $data['purchase_unique_id'] = $this->input->post('purchase_unique_id');
            $data['project_id'] = $this->input->post('project_id');
            $data['sub_total'] = $this->input->post('sub_total');
            $data['discount'] = $this->input->post('discount');
            $data['net_total'] = $this->input->post('net_total');
            $data['user_id'] = $this->session->userdata('user_id');
            $this->db->insert('purchase', $data);
            $purchase_id = $this->db->insert_id();

            $income_head_id = $this->input->post('income_head_id');
            $quantity = $this->input->post('quantity');
            $unit_price = $this->input->post('unit_price');
            $total_price = $this->input->post('total_price');


            for ($i = 0; $i < count($total_price); $i++) {
                //print_r(($total_price[$i]));

                if ($total_price[$i] != '') {
                    //print_r(($total_price[$i]));

                    $data_details = array(
                        'purchase_id' => $purchase_id,
                        'project_id' => $this->input->post('project_id'),
                        'purchase_unique_id' => $this->input->post('purchase_unique_id'),
                        'income_head_id' => $income_head_id[$i],
                        'quantity' => $quantity[$i],
                        'unit_price' => $unit_price[$i],
                        'total_price' => $total_price[$i],
                        'user_id' => $this->session->userdata('user_id'),
                        'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                    );
                    $this->db->insert('purchase_details', $data_details);
                }
            }

        }

        $sdata = array();
        $sdata['success'] = "Data  has been saved successfully";
        $this->session->set_userdata($sdata);
        $data['output_content'] = $this->load->view('backend/add_purchase', '', true);
        $data['flag'] = '';
        $this->load->view('admin_content', $data);

    }

}
