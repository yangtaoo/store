<?php
require_once('D:/projects/greenviro/application/greenviro_mod.php');

/**
 *  此处使用json书写输入是为了方便看清系统层次结构
 *  第一个为一元系统输入示例 
 */


function gt_interface_test()
{
    $inputStr='
    {
        "sysobj_id": "47",
        "sysobj_type": "system",
        "system_id": "10",
        "system_name": "华融多晶硅1#系统",
        "type_sys": "1002",
        "type_rf": "3001",
        "evap_sys": [
            {
                "sysobj_id":"21",
                "evap_sys_id": "99",
                "evap_sys_idx": "0",
                "t_evap": "-20.0",
                "type_evap": "5001",
                "num_evap": "1",
                "type_defrost": "7002",
                "type_rffd": "4001",
                "num_cb": "2",
                "type_ev": "6001",
                "num_cr": "1",
                "type_secrf": "14001",
                "type_secrf_string": "",
                "cyclingbarrel": [
                    {
                        "cyclingbarrel_id": "41",
                        "num_rfp_per_cb": "3"
                    },
                    {
                        "cyclingbarrel_id": "42",
                        "num_rfp_per_cb": "4"
                    }
                ],
                "coldroom": [
                    {
                        "coldroom_id": "30",
                        "cr_idx": "0",
                        "cr_nickname": "梨子库",
                        "num_air_cooler _per_cr": "2"
                    }
                ],
                "chiller": []
            },
            {
                "sysobj_id":"20",
                "evap_sys_id": "68",
                "evap_sys_idx": "1",
                "t_evap": "-20.0",
                "type_evap": "5003",
                "num_evap": "1",
                "type_defrost": "7001",
                "type_rffd": "4002",
                "num_cb": "0",
                "type_ev": "6001",
                "num_cr": "0",
                "type_secrf": "14001",
                "type_secrf_string": "",
                "cyclingbarrel": [],
                "chiller": [
                    {
                        "chiller_id": "33",
                        "num_secrfp_per_chiller": "4"
                    }
                ],
                "coldroom": []
            }
        ],
        "comp_sys": [
            {
                "sysobj_id":"12",
                "comp_sys_id": "49",
                "comp_sys_idx": "0",
                "type_comp": "8002",
                "type_stage_comp": "12001",
                "num_comp": "1",
                "has_gas_liquid_seprator": "1",
                "has_economizer": "1",
                "p_middle": "10.5",
                "type_oc": "9001",
                "num_wp_wc_oc": "1",
                "num_wt_wc_oc": "1",
                "has_process_cooler": "1",
                "t_evap_pc": "10.0",
                "compressor":[
                    {
                        "compressor_id":"24",
                        "compressor_idx":"1"
                    }
                ]

            },
            {
                "sysobj_id":"13",
                "comp_sys_id": "50",
                "comp_sys_idx": "1",
                "type_comp": "8002",
                "type_stage_comp": "12001",
                "num_comp": "0",
                "has_gas_liquid_seprator": "0",
                "has_economizer": "0",
                "type_oc": "9001",
                "num_wp_wc_oc": "1",
                "num_wt_wc_oc": "1"
            }
        ],
        "cond_sys": [
            {
                "sysobj_id": "10",
                "cond_sys_id": "62",
                "cond_sys_idx": "0",
                "ctrl_p_cond": "11002",
                "num_cond": "2",
                "type_cond": "10002",
                "num_wp_evap_cond": "0",
                "num_wp_wc_cond": "1",
                "num_wt_wc_cond": "1",
                "cond": [
                    {
                        "cond_id": "22",
                        "num_fan_per_ac_cond": "2",
                        "cond_idx": "0"
                    },
                    {
                        "cond_id": "23",
                        "num_fan_per_ac_cond": "1",
                        "cond_idx": "1"
                    }
                ]
            }
        ],
        "product_zone":[
            {
                "sysobj_id": "600",
                "evap_sys_id":"99"
            },
            {
                "sysobj_id": "700",
                "evap_sys_id":"68"
            }
        ],
        "equipment_zone":[
            {
                "sysobj_id":"601",
                "evap_sys_id":"99"
            },
            {
                "sysobj_id": "705",
                "evap_sys_id":"68"
            }
        ]
    }';

    // 二元系统输入示例
    $inputStr1='
    {
        "sysobj_id": "25",
        "sysobj_type": "system",
        "children": [
            {
                "sysobj_id": "47",
                "sysobj_type": "system",
                "system_id": "10",
                "system_name": "",
                "type_sys": "1002",
                "type_rf": "3001",
                "evap_sys": [
                    {
                        "sysobj_id": "21",
                        "evap_sys_id": "97",
                        "evap_sys_idx": "0",
                        "t_evap": "-20.0",
                        "type_evap": "5001",
                        "num_evap": "1",
                        "type_defrost": "7002",
                        "type_rffd": "4001",
                        "num_cb": "2",
                        "type_ev": "6001",
                        "num_cr": "1",
                        "type_secrf": "14001",
                        "type_secrf_string": "",
                        "cyclingbarrel": [
                            {
                                "cyclingbarrel_id": "41",
                                "num_rfp_per_cb": "3"
                            },
                            {
                                "cyclingbarrel_id": "42",
                                "num_rfp_per_cb": "4"
                            }
                        ],
                        "coldroom": [
                            {
                                "coldroom_id": "30",
                                "cr_idx": "0",
                                "cr_nickname": "梨子库",
                                "num_air_cooler _per_cr": "2"
                            }
                        ],
                        "chiller": []
                    },
                    {
                        "sysobj_id": "20",
                        "evap_sys_id": "98",
                        "evap_sys_idx": "1",
                        "t_evap": "-20.0",
                        "type_evap": "5003",
                        "num_evap": "1",
                        "type_defrost": "7001",
                        "type_rffd": "4002",
                        "num_cb": "0",
                        "type_ev": "6001",
                        "num_cr": "0",
                        "type_secrf": "14001",
                        "type_secrf_string": "",
                        "cyclingbarrel": [],
                        "chiller": [
                            {
                                "chiller_id": "33",
                                "num_secrfp_per_chiller": "4"
                            }
                        ],
                        "coldroom": []
                    }
                ],
                "comp_sys": [
                    {
                        "sysobj_id": "12",
                        "comp_sys_id": "49",
                        "comp_sys_idx": "0",
                        "type_comp": "8002",
                        "type_stage_comp": "12001",
                        "num_comp": "3",
                        "has_gas_liquid_seprator": "1",
                        "has_economizer": "1",
                        "p_middle": "10.5",
                        "type_oc": "9001",
                        "num_wp_wc_oc": "1",
                        "num_wt_wc_oc": "1",
                        "has_process_cooler": "1",
                        "t_evap_pc": "10.0",
                        "compressor":[
                            {
                                "compressor_id":"20",
                                "compressor_idx":"1"
                            },
                            {
                                "compressor_id":"21",
                                "compressor_idx":"2"
                            },
                            {
                                "compressor_id":"26",
                                "compressor_idx":"3"
                            }
                        ]
                    },
                    {
                        "sysobj_id": "13",
                        "comp_sys_id": "50",
                        "comp_sys_idx": "1",
                        "type_comp": "8002",
                        "type_stage_comp": "12001",
                        "num_comp": "0",
                        "has_gas_liquid_seprator": "0",
                        "has_economizer": "0",
                        "type_oc": "9001",
                        "num_wp_wc_oc": "1",
                        "num_wt_wc_oc": "1",
                        "compressor":[]
                    }
                ],
                "cond_sys": [
                    {
                        "sysobj_id": "10",
                        "cond_sys_id": "62",
                        "cond_sys_idx": "0",
                        "ctrl_p_cond": "11002",
                        "num_cond": "2",
                        "type_cond": "10002",
                        "num_wp_evap_cond": "0",
                        "num_wp_wc_cond": "1",
                        "num_wt_wc_cond": "1",
                        "cond": [
                            {
                                "cond_id": "22",
                                "num_fan_per_ac_cond": "2",
                                "cond_idx": "0"
                            },
                            {
                                "cond_id": "23",
                                "num_fan_per_ac_cond": "1",
                                "cond_idx": "1"
                            }
                        ]
                    }
                ],
                "product_zone":[
                    {
                        "sysobj_id": "304",
                        "evap_sys_id":"97"
                    },
                    {
                        "sysobj_id": "509",
                        "evap_sys_id":"98"
                    }
                ],
                "equipment_zone":[
                    {
                        "sysobj_id":"603",
                        "evap_sys_id":"97"
                    },
                    {
                        "sysobj_id": "708",
                        "evap_sys_id":"98"
                    }
                ]
            },
            {
                "sysobj_id": "90",
                "sysobj_type": "system",
                "system_id": "73",
                "system_name": "",
                "type_sys": "1002",
                "type_rf": "3001",
                "evap_sys": [
                    {
                        "sysobj_id": "71",
                        "evap_sys_id": "97",
                        "evap_sys_idx": "0",
                        "t_evap": "-20.0",
                        "type_evap": "5001",
                        "num_evap": "1",
                        "type_defrost": "7002",
                        "type_rffd": "4001",
                        "num_cb": "2",
                        "type_ev": "6001",
                        "num_cr": "1",
                        "type_secrf": "14001",
                        "type_secrf_string": "",
                        "cyclingbarrel": [
                            {
                                "cyclingbarrel_id": "41",
                                "num_rfp_per_cb": "3"
                            },
                            {
                                "cyclingbarrel_id": "42",
                                "num_rfp_per_cb": "4"
                            }
                        ],
                        "coldroom": [
                            {
                                "coldroom_id": "30",
                                "cr_idx": "0",
                                "cr_nickname": "梨子库",
                                "num_air_cooler _per_cr": "2"
                            }
                        ],
                        "chiller": []
                    }
                ],
                "comp_sys": [
                    {
                        "sysobj_id": "75",
                        "comp_sys_id": "49",
                        "comp_sys_idx": "0",
                        "type_comp": "8002",
                        "type_stage_comp": "12001",
                        "num_comp": "0",
                        "has_gas_liquid_seprator": "1",
                        "has_economizer": "1",
                        "p_middle": "10.5",
                        "type_oc": "9001",
                        "num_wp_wc_oc": "1",
                        "num_wt_wc_oc": "1",
                        "has_process_cooler": "1",
                        "t_evap_pc": "10.0",
                        "compressor":[]
                    }
                ],
                "cond_sys": [
                    {
                        "sysobj_id": "70",
                        "cond_sys_id": "62",
                        "cond_sys_idx": "0",
                        "ctrl_p_cond": "11002",
                        "num_cond": "2",
                        "type_cond": "10002",
                        "num_wp_evap_cond": "0",
                        "num_wp_wc_cond": "1",
                        "num_wt_wc_cond": "1",
                        "cond": [
                            {
                                "cond_id": "29",
                                "num_fan_per_ac_cond": "2",
                                "cond_idx": "0"
                            },
                            {
                                "cond_id": "33",
                                "num_fan_per_ac_cond": "1",
                                "cond_idx": "1"
                            }
                        ]
                    }
                ],
                "product_zone":[
                    {
                        "sysobj_id": "400",
                        "evap_sys_id": "97"
                    }
                ],
                "equipment_zone":[
                    {
                        "sysobj_id":"401",
                        "evap_sys_id": "97"
                    }
                ]
            }
        ]
    }';
    
    //$input = json_decode($inputStr,TRUE); 
    //$ret = gt_get_sys_param($input);    
    $input1 = json_decode($inputStr1,TRUE);
    $ret = gt_get_all_param($input1);
    echo '<br><br>';
    echo json_encode($ret);
    var_dump(gt_get_param_property('t_subcool_cond_1'));
    var_dump(gt_get_param_property('t_cr_0',array('product_zone'=>304,'cr_idx'=>0)));
    var_dump(gt_get_param_property('t_amb'));
}

gt_interface_test();
