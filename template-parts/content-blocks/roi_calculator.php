<?php
function output_roi_tooltip($acf_group, $acf_field_name) {
    if (array_key_exists($acf_field_name, $acf_group) && !empty($acf_group[$acf_field_name])) {
        $tooltip = str_replace('"', "'", $acf_group[$acf_field_name]);
        $tooltipQuestionMark = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 11 11" width="11" height="11" style="enable-background:new 0 0 11 11;" xml:space="preserve">
            <circle fill="#02577C" class="st0" cx="5.5" cy="5.5" r="5.5"/>
            <path fill="#FFFFFF" class="st1" d="M5.5,2.6c-0.3,0-0.5,0-0.8,0.1C4.5,2.7,4.2,2.8,3.9,3L3.6,1.9c0.3-0.2,0.6-0.3,1-0.4c0.4-0.1,0.7-0.1,1.1-0.1
            c0.5,0,0.8,0.1,1.1,0.2s0.5,0.3,0.7,0.5c0.2,0.2,0.3,0.4,0.4,0.6c0.1,0.2,0.1,0.4,0.1,0.7c0,0.3,0,0.5-0.1,0.7
            C7.7,4.2,7.6,4.4,7.4,4.6C7.3,4.8,7.1,5,7,5.1S6.6,5.4,6.5,5.6S6.2,5.9,6.1,6.1C6,6.3,6,6.5,6,6.7c0,0,0,0.1,0,0.1S6,7,6,7H4.8
            c0-0.1,0-0.2,0-0.2c0-0.1,0-0.2,0-0.2c0-0.3,0-0.5,0.1-0.7s0.2-0.4,0.3-0.5C5.4,5.1,5.5,5,5.6,4.8s0.3-0.3,0.4-0.4
            c0.1-0.1,0.2-0.3,0.3-0.4c0.1-0.2,0.1-0.3,0.1-0.5c0-0.3-0.1-0.5-0.3-0.6S5.8,2.6,5.5,2.6z"/>
            <path fill="#FFFFFF" class="st1" d="M6.4,8.7c0,0.3-0.1,0.5-0.3,0.7C5.9,9.6,5.7,9.6,5.5,9.6C5.2,9.6,5,9.6,4.8,9.4C4.6,9.2,4.5,9,4.5,8.7
            c0-0.3,0.1-0.5,0.3-0.7C5,7.9,5.2,7.8,5.5,7.8c0.3,0,0.5,0.1,0.7,0.3C6.3,8.2,6.4,8.5,6.4,8.7z"/>
            </svg>';

        echo '<span class="tooltip-trigger tooltips" data-html="true" data-placement="bottom" title="'.$tooltip.'" data-original-title="'.$tooltip.'">'.$tooltipQuestionMark.'</span>';
    }
}
?>
<div class="container-wrap blue-light-dark-gradient">
    <div class="container">
        <div class="row d-flex flex-wrap">
            <div class="col-xs-12 col-md-6 roi-input-col">
                <div class="col-inner">
                    <h2><?= $block['inputs']['title']; ?></h2>
                    <p><?= $block['inputs']['description']; ?></p>
                    <hr/>
                    <h3>About your team</h3>
                    <div class="form-group">
                        <label for="active_agents" class="d-block strong">Number of active agents <?php output_roi_tooltip($block['inputs'], 'number_of_active_agents_tooltip'); ?></label>
                        <input id="active_agents" data-provide="slider" data-slider-id='active_agents_slider' type="text" data-slider-min="1" data-slider-ticks-snap-bounds="5" data-slider-ticks="[1, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]" data-slider-max="100" data-slider-step="5" data-slider-value="50" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="active_agents" class="d-block strong">Contact center hours <?php output_roi_tooltip($block['inputs'], 'contact_center_hours_tooltip'); ?></label>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input id="call_center_hours_day" class="input-small" type="number" value="8" min="1" max="24" /> hours/day
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input id="call_center_days_week" class="input-small" type="number" value="5" min="1" max="7" /> days/week
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="agent_compensation" class="d-block strong">Average compensation per agent <?php output_roi_tooltip($block['inputs'], 'average_compensation_per_agent_tooltip'); ?></label>
                        <input id="agent_compensation" data-provide="slider" data-slider-id='agent_compensation_slider' type="text" data-slider-step="500" data-slider-min="10000" data-slider-max="100000" data-slider-step="1" data-slider-value="50000" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>

                    <hr />

                    <h3>About your calls</h3>
                    <div class="form-group">
                        <label for="call_length" class="d-block strong">Average length of call <?php output_roi_tooltip($block['inputs'], 'avarage_length_of_call_tooltip'); ?></label>
                        <input id="call_length" data-provide="slider" data-slider-id='call_length_slider' type="text" data-slider-min="1" data-slider-max="60" data-slider-step="1" data-slider-value="6" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="form-group">
                        <label for="call_cost" class="d-block strong">System cost per call <?php output_roi_tooltip($block['inputs'], 'system_cost_per_call_tooltip'); ?></label>
                        <input id="call_cost" data-provide="slider" data-slider-id='call_cost_slider' type="text" data-slider-min="0.25" data-slider-max="2" data-slider-step="0.25" data-slider-ticks-snap-bounds="0.25" data-slider-ticks="[0.25, 0.5, 0.75, 1.00, 1.25, 1.5, 1.75, 2.00]" data-slider-value="1" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>

                    <hr />

                    <h3>Your chats</h3>
                    <div class="form-group">
                        <label class="d-block strong">Preferred chat package <?php output_roi_tooltip($block['inputs'], 'preferred_chat_package_tooltip'); ?></label>
                        <label class="radio-inline">
                            <input type="radio" name="chatPackage" id="chatPackageTeam" value="Team" data-rate="348"> Team
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="chatPackage" id="chatPackageBusiness" value="Business" data-rate="588" checked> Business
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="chatPackage" id="chatPackageEnterprise" value="Enterprise" data-rate="1308"> Enterprise
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="chat_length" class="d-block strong">Average length of chat <?php output_roi_tooltip($block['inputs'], 'avarage_length_of_chat_tooltip'); ?></label>
                        <input id="chat_length" data-provide="slider" data-slider-id='chat_length_slider' type="text" data-slider-min="1" data-slider-max="30" data-slider-step="1" data-slider-value="10" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="form-group">
                        <label for="concurrent_chats" class="d-block strong">Number of concurrent chats per agent <?php output_roi_tooltip($block['inputs'], 'number_of_concurrent_chats_per_agent_tooltip'); ?></label>
                        <input id="concurrent_chats" data-provide="slider" data-slider-id='concurrent_chats_slider' type="text" data-slider-min="1" data-slider-max="30" data-slider-step="1" data-slider-value="3" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="form-group">
                        <label for="percent_calls_to_chat" class="d-block strong">Percentage of calls deflected to chat <?php output_roi_tooltip($block['inputs'], 'percent_calls_to_chat_tooltip'); ?></label>
                        <input id="percent_calls_to_chat" data-provide="slider" data-slider-id='percent_calls_to_chat_slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="25" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 text-light roi-results-col">
                <div class="col-inner">
                    <h2><?= $block['results']['title']; ?></h2>
                    <p><?= $block['results']['description']; ?></p>
                    <hr/>
                    <h5 class="text-light">If you deflect <span id="percent_redirection_result">25</span>% of queries from phone to chat, you will be able to handle: <?php output_roi_tooltip($block['results'], 'if_you_deflect_tooltip'); ?></h5>
                    <div class="row capacity-results">
                        <div class="col-xs-4 text-center item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/phone.svg" alt="Phone Icon" width="28" /><br/>
                            <span id="handle_calls_result" class="font-weight-heavy">XXXX</span>
                            <br/>
                            calls
                        </div>
                        <div class="col-xs-4 text-center item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/chat.svg" alt="Chat Icon" width="33" /><br/>
                            <span id="handle_chats_result" class="font-weight-heavy">XXXX</span>
                            <br/>
                            chats
                        </div>
                        <div class="col-xs-4 text-center item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/phone.svg" alt="Phone Icon" width="28" /> <img src="<?= get_template_directory_uri(); ?>/dist/images/chat.svg" alt="Chat Icon" width="33" /><br/>
                            <span id="handle_total_result" class="font-weight-heavy">XXXX</span>
                            <br/>
                            total queries
                        </div>
                    </div>
                    <br/>
                    <h5 class="text-light">To handle that capacity, you will need: <?php output_roi_tooltip($block['results'], 'handle_capacity_tooltip'); ?></h5>
                    <div class="row capacity-results">
                        <div class="col-xs-4 text-center item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/phone.svg" alt="Phone Icon" width="28" /><br/>
                            <span id="agents_phone_result" class="font-weight-heavy">XXXX</span>
                            <br/>
                            agents for phone
                        </div>
                        <div class="col-xs-4 text-center item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/chat.svg" alt="Chat Icon" width="33" /><br/>
                            <span id="agents_chat_result" class="font-weight-heavy">XXXX</span>
                            <br/>
                            agents for chat
                        </div>
                        <div class="col-xs-4 text-center item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/phone.svg" alt="Phone Icon" width="28" /> <img src="<?= get_template_directory_uri(); ?>/dist/images/chat.svg" alt="Chat Icon" width="33" /><br/>
                            <span id="agents_total_result" class="font-weight-heavy">XXXX</span>
                            <br/>
                            total agents
                        </div>
                    </div>
                    <hr/>
                    <h5 class="text-light">Your total estimated costs are:</h5>
                    <div class="estimate-costs-legend">
                        <div class="item">
                            <span class="legend-colour" style="background: #0091d1;"></span>
                            System costs for phone
                        </div>
                        <div class="item">
                            <span class="legend-colour" style="background: #3dc4ff;"></span>
                            Labor costs for phone
                        </div>
                        <div class="item">
                            <span class="legend-colour" style="background: #EEFFAE;"></span>
                            System costs for chat
                        </div>
                        <div class="item">
                            <span class="legend-colour" style="background: #b2e43a;"></span>
                            Labor costs for chat
                        </div>
                    </div>
                    <div class="roi-results">
                        <div class="roi-result">
                            <div id="calls_year_bar" class="roi-bar-chart">
                                <div class="bar">
                                    <div id="system_cost_phone_bar" class="bar-segment" style="background: #0091d1;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                    <div id="labour_cost_phone_bar" class="bar-segment" style="background: #3dc4ff;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                </div>
                                <div class="label">
                                    <div id="total_cost_phone_result" class="font-weight-heavy">$<span class="value">XXXXX</span></div>
                                    <small>(100% phone)</small>
                                </div>
                            </div>
                        </div>
                        <div class="roi-result-comparison d-flex">
                            <div class="inner text-center">or</div>
                        </div>
                        <div class="roi-result">
                            <div id="chats_year_bar" class="roi-bar-chart">
                                <div class="bar">
                                    <div id="deflected_system_cost_chat_bar" class="bar-segment" style="background: #EEFFAE;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                    <div id="deflected_labour_cost_chat_bar" class="bar-segment" style="background: #b2e43a;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                    <div id="deflected_system_cost_phone_bar" class="bar-segment" style="background: #0091d1;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                    <div id="deflected_labour_cost_phone_bar" class="bar-segment" style="background: #3dc4ff;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                </div>
                                <div class="label">
                                    <div id="total_deflected_cost_result" class="font-weight-heavy">$<span class="value">XXXXX</span></div>
                                    <small>(<span id="deflected_phone_percent_result">XX</span>% phone, <span id="deflected_chat_percent_result">XX</span>% chat)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="bar-chart-totals text-center">
                        By deflecting <span id="deflected_chat_percent_result_comparison"></span>% of queries to chat, you will realize a net savings of:<br/>
                        <h4>$<span id="deflected_chat_savings"></span> per year</h4>
                    </div>
                    <hr/>
                    <div class="roi-results row text-center">
                        <div class="col-xs-6 roi-icon-result">
                            <div id="one_year_roi">
                                <div class="icon"><img src="<?= get_template_directory_uri(); ?>/dist/images/roi-icon.png" alt="ROI Icon" /></div>
                                <div class="label">ROI in year one <?php output_roi_tooltip($block['results'], 'roi_in_year_one_tooltip'); ?></div>
                                <div class="value-wrap"><span class="value"></span>%</div>
                            </div>
                        </div>
                        <div class="col-xs-6 roi-icon-result">
                            <div id="payback_period">
                                <div class="icon"><img src="<?= get_template_directory_uri(); ?>/dist/images/roi-calendar-icon.png" alt="ROI Calendar Icon" /></div>
                                <div class="label">Payback period <?php output_roi_tooltip($block['results'], 'payback_period_tooltip'); ?></div>
                                <div class="value-wrap"><span class="value"></span> days</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container section-footer">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?php
                echo '<h4>'.$block['report_form']['title'].'</h4>';
                echo '<p class="h2">'.$block['report_form']['description'].'</p>';
            ?>
        </div>
        <div class="col-xs-12 col-md-6 form-col">
            <?= $block['report_form']['form_code']; ?>
        </div>
    </div>
</div>