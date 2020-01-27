<?php
function output_roi_tooltip($acf_group, $acf_field_name, $dark = false) {
    if (array_key_exists($acf_field_name, $acf_group) && !empty(trim($acf_group[$acf_field_name]))) {
        $tooltip = str_replace('"', "'", $acf_group[$acf_field_name]);

        $tooltipQuestionMark = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 11 11" width="12" height="12" style="enable-background:new 0 0 11 11;" xml:space="preserve">
            <circle fill="#02577C" class="st0" cx="5.5" cy="5.5" r="5.5"/>
            <path fill="#FFFFFF" class="st1" d="M5.5,2.6c-0.3,0-0.5,0-0.8,0.1C4.5,2.7,4.2,2.8,3.9,3L3.6,1.9c0.3-0.2,0.6-0.3,1-0.4c0.4-0.1,0.7-0.1,1.1-0.1
            c0.5,0,0.8,0.1,1.1,0.2s0.5,0.3,0.7,0.5c0.2,0.2,0.3,0.4,0.4,0.6c0.1,0.2,0.1,0.4,0.1,0.7c0,0.3,0,0.5-0.1,0.7
            C7.7,4.2,7.6,4.4,7.4,4.6C7.3,4.8,7.1,5,7,5.1S6.6,5.4,6.5,5.6S6.2,5.9,6.1,6.1C6,6.3,6,6.5,6,6.7c0,0,0,0.1,0,0.1S6,7,6,7H4.8
            c0-0.1,0-0.2,0-0.2c0-0.1,0-0.2,0-0.2c0-0.3,0-0.5,0.1-0.7s0.2-0.4,0.3-0.5C5.4,5.1,5.5,5,5.6,4.8s0.3-0.3,0.4-0.4
            c0.1-0.1,0.2-0.3,0.3-0.4c0.1-0.2,0.1-0.3,0.1-0.5c0-0.3-0.1-0.5-0.3-0.6S5.8,2.6,5.5,2.6z"/>
            <path fill="#FFFFFF" class="st1" d="M6.4,8.7c0,0.3-0.1,0.5-0.3,0.7C5.9,9.6,5.7,9.6,5.5,9.6C5.2,9.6,5,9.6,4.8,9.4C4.6,9.2,4.5,9,4.5,8.7
            c0-0.3,0.1-0.5,0.3-0.7C5,7.9,5.2,7.8,5.5,7.8c0.3,0,0.5,0.1,0.7,0.3C6.3,8.2,6.4,8.5,6.4,8.7z"/>
            </svg>';

        if ($dark) {
            $tooltipQuestionMark = str_replace('02577C', '3dc4ff', $tooltipQuestionMark);
            $tooltipQuestionMark = str_replace('FFFFFF', '002c42', $tooltipQuestionMark);
        }

        echo '<span class="tooltip-trigger tooltips" data-html="true" data-placement="bottom" title="'.$tooltip.'" data-original-title="'.$tooltip.'">'.$tooltipQuestionMark.'</span>';
    }
}
?>
<div class="container-wrap blue-light-dark-gray-gradient">
    <div class="container">
        <div class="row d-flex flex-wrap">
            <div class="col-xs-12 col-md-6 roi-input-col">
                <div class="col-inner">
                    <h2><?= $block['inputs']['title']; ?></h2>
                    <p><?= $block['inputs']['description']; ?></p>
                    <br/>
                    <h3>About your team</h3>
                    <div class="form-group">
                        <label for="active_agents" class="d-block strong">Number of active live chat agents <?php output_roi_tooltip($block['inputs'], 'number_of_active_agents_tooltip'); ?></label>
                        <input id="active_agents" data-provide="slider" data-slider-id='active_agents_slider' type="text" data-slider-min="1" data-slider-ticks-snap-bounds="5" data-slider-lock-to-ticks="true" data-slider-ticks="[1, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]" data-slider-max="100" data-slider-step="5" data-slider-value="20" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="active_agents" class="d-block strong">Live chat availability <?php output_roi_tooltip($block['inputs'], 'contact_center_hours_tooltip'); ?></label>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <input id="call_center_hours_day" class="input-small" type="number" value="8" min="1" max="24" /> <small>hours/day</small>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <input id="call_center_days_week" class="input-small" type="number" value="5" min="1" max="7" /> <small>days/week</small>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <input id="call_center_weeks_year" class="input-small" type="number" value="50" min="0" max="52" /> <small>weeks/year</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="agent_compensation" class="d-block strong">Average compensation per agent <?php output_roi_tooltip($block['inputs'], 'average_compensation_per_agent_tooltip'); ?></label>
                        <input id="agent_compensation" data-provide="slider" data-slider-id='agent_compensation_slider' type="text" data-slider-step="500" data-slider-min="10000" data-slider-max="100000" data-slider-step="1" data-slider-value="50000" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="form-group">
                        <label for="percent_of_day_spent_chatting" class="d-block strong">Percent of actual time spent chatting per day <?php output_roi_tooltip($block['inputs'], 'percent_of_day_spent_chatting_tooltip'); ?></label>
                        <input id="percent_of_day_spent_chatting" data-provide="slider" data-slider-id='percent_of_day_spent_chatting_slider' type="text" data-slider-step="10" data-slider-min="20" data-slider-max="100" data-slider-value="90" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <hr />
                    <h3>Your chats</h3>
                    <div class="form-group">
                        <label for="chat_length" class="d-block strong">Average length of chat <?php output_roi_tooltip($block['inputs'], 'avarage_length_of_chat_tooltip'); ?></label>
                        <input id="chat_length" data-provide="slider" data-slider-id='chat_length_slider' type="text" data-slider-min="1" data-slider-max="30" data-slider-step="1" data-slider-value="15" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="form-group">
                        <label for="concurrent_chats" class="d-block strong">Number of concurrent chats per agent <?php output_roi_tooltip($block['inputs'], 'number_of_concurrent_chats_per_agent_tooltip'); ?></label>
                        <input id="concurrent_chats" data-provide="slider" data-slider-id='concurrent_chats_slider' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="3" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="form-group">
                        <label for="time_spent_looking_for_answers" class="d-block strong">How much time per chat do your agents spend looking for answers? <?php output_roi_tooltip($block['inputs'], 'time_spent_looking_for_answers_tooltip'); ?></label>
                        <input id="time_spent_looking_for_answers" data-slider-id='time_spent_looking_for_answers_slider' type="text" data-slider-min="30" data-slider-max="600" data-slider-step="30" data-slider-value="120" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="form-group">
                        <label class="d-block strong">Your current Comm100 chat package <?php output_roi_tooltip($block['inputs'], 'current_comm100_package_tooltip'); ?></label>
                        <label class="radio-inline">
                            <input type="radio" name="chatPackage" id="chatPackageTeam" value="Team" data-rate="348"> Team
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="chatPackage" id="chatPackageBusiness" value="Business" data-rate="588"> Business
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="chatPackage" id="chatPackageEnterprise" value="Enterprise" data-rate="1308" checked> Enterprise
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="d-block strong">Do you use Comm100 Chatbot and/or Knowledge Base? <?php output_roi_tooltip($block['inputs'], 'use_comm100_chatbot_or_kb_tooltip'); ?></label>
                        <label class="radio-inline">
                            <input type="radio" name="agentAssistOption" id="agentAssistWithChatbot" value="With Chatbot" data-rate="125"> Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="agentAssistOption" id="agentAssistNoChatbot" value="No Chatbot" data-rate="85" checked> No
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 roi-results-col bg-gray-dark">
                <div class="col-inner">
                    <div class="bg-gray-medium">
                        <h2><?= $block['results']['title']; ?></h2>
                        <p class="mb-0"><?= $block['results']['description']; ?></p>
                        <hr class="my-1" />
                        <p class="mb-0">Your team spends <span class="text-primary"><span id="percent_time_spent_searching">XX</span>%</span> of their time searching for answers. If you could eliminate search time completely: <?php output_roi_tooltip($block['results'], 'your_teams_chat_capacity_tooltip'); ?></p>
                        <br/>
                        <p class="mb-0">New average chat length: <?php output_roi_tooltip($block['results'], 'new_average_chat_length_tooltip', true); ?></p>
                        <h3 class="text-success mb-0"><strong><span id="new_chat_length">XX</span> minutes</strong></h3>
                        <br/>
                        <p class="mb-0"><strong>Number of chats per year that your team can handle: <?php output_roi_tooltip($block['results'], 'chats_per_year_team_can_handle_tooltip', true); ?></strong></p>
                        <div class="row capacity-results d-flex">
                            <div class="col-xs-5 text-center item">
                                <img src="<?= get_template_directory_uri(); ?>/dist/images/chat-agents-icons.svg" alt="Live Chat Agent Icon" width="120" /><br/>
                                <span id="current_chat_capacity" class="value text-primary font-weight-heavy">XXXX</span>
                                <br/>
                                Current annual chat capacity per team
                            </div>
                            <div class="col-xs-2 text-center item comparison d-flex align-items-center font-weight-heavy justify-content-center">
                                <span class="inner roi-result-comparison">or</span>
                            </div>
                            <div class="col-xs-5 text-center item">
                                <img src="<?= get_template_directory_uri(); ?>/dist/images/assist-agents-icons.svg" alt="Live Chat Agent Icon" width="120" /> <br/>
                                <span class="new_chat_capacity value text-success font-weight-heavy">XXXX</span>
                                <br/>
                                New annual chat capacity per team
                            </div>
                        </div>
                        <hr/>
                        <p class="mb-0">Adding Agent Assist to your current team will reduce your per-chat labor costs by</p>
                        <h3 class="text-success"><strong><span id="reduced_labor_cost_percent">XX.XX</span>%</strong></h3>
                        <p class="mb-0">And extend your total chat capacity by</p>
                        <div class="mb-0"><h3 class="text-success d-inline-block"><strong><span id="extend_chat_capacity_percent">XX.X</span>%</strong></h3> or <h3 class="text-success d-inline-block strong"><strong><span id="extend_chat_capacity">XXX,XXX</span></strong></h3> chats per year.</div>
                        <h5 class="">To handle the new capacity of <span class="new_chat_capacity text-success">XXXX</span> per year you will need: <?php output_roi_tooltip($block['results'], 'new_capacity_of_chats_per_year_tooltip', true); ?></h5>
                        <div class="row capacity-results d-flex mb-0">
                            <div class="col-xs-5 text-center item">
                                <img src="<?= get_template_directory_uri(); ?>/dist/images/chat-agents-icons.svg" alt="Live Chat Agent Icon" width="120" /><br/>
                                <span id="agents_new_capacity" class="value text-primary font-weight-heavy">XXXX</span>
                                <br/>
                                agents
                            </div>
                            <div class="col-xs-2 text-center item comparison d-flex align-items-center font-weight-heavy justify-content-center">
                                <span class="inner roi-result-comparison">or</span>
                            </div>
                            <div class="col-xs-5 text-center item">
                                <img src="<?= get_template_directory_uri(); ?>/dist/images/assist-agents-icons.svg" alt="Live Chat Agent Icon" width="120" /> <br/>
                                <span class="agents_new_capacity_with_assist value text-success font-weight-heavy">XXXX</span>
                                <br/>
                                agents + Agent Assist
                            </div>
                        </div>
                    </div>
                    <?php /*
                    <p class="mb-0">Alternately, with a new annual capacity of</p>
                    <h3 class="mb-0 text-primary"><strong><span class="new_chat_capacity">XXX,XXX</span></strong></h3>
                    <p class="mb-0">chats per agent using Agent Assist, you will need</p>
                    <div class="mb-0"><h3 class="text-primary d-inline-block mb-0"><strong><span class="agents_new_capacity_with_assist">XX</span></strong></h3></div>
                    <p class="mb-1">agents to handle your current volume.</p>
                    */ ?>
                    <h5 class="">Your total costs would be: <?php output_roi_tooltip($block['results'], 'total_costs_tooltip', true); ?></h5>
                    <div class="estimate-costs-legend">
                        <div class="item">
                            <span class="legend-colour" style="background: #0091D1;"></span>
                            Annual team compensation
                        </div>
                        <div class="item">
                            <span class="legend-colour" style="background: #9FDD09;"></span>
                            Annual Comm100 subscription
                        </div>
                    </div>
                    <div class="roi-results">
                        <div class="roi-result">
                            <div id="current_team_bar" class="roi-bar-chart">
                                <div class="bar">
                                    <div id="current_team_subscription_cost_bar" class="bar-segment" style="background: #9FDD09;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                    <div id="current_team_compensation_cost_bar" class="bar-segment" style="background: #0091D1;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                </div>
                                <div class="label">
                                    <small>Total cost with<br/>current team size</small>
                                    <div id="current_team_cost" class="text-primary font-weight-heavy">$<span class="value">XXXXX</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="roi-result-comparison font-weight-heavy d-flex justify-content-center">
                            <div class="inner text-center">or</div>
                        </div>
                        <div class="roi-result">
                            <div id="new_team_bar" class="roi-bar-chart">
                                <div class="bar">
                                    <div id="new_team_subscription_cost_bar" class="bar-segment" style="background: #9FDD09;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                    <div id="new_team_compensation_cost_bar" class="bar-segment" style="background: #0091D1;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                </div>
                                <div class="label">
                                    <small>Total anticipated cost<br/>with new team size</small>
                                    <div id="new_team_cost" class="text-success font-weight-heavy">$<span class="value">XXXXX</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="bar-chart-totals text-center">
                        This will reduce your total chat-related costs by
                        <h4 class="text-primary">$<span id="adding_assist_savings"></span> per year</h4>
                    </div>
                    <hr/>
                    <div class="roi-results row text-center">
                        <div class="col-xs-6 roi-icon-result">
                            <div id="one_year_roi">
                                <div class="icon"><img src="<?= get_template_directory_uri(); ?>/dist/images/agent-assist-roi-icon.svg" alt="ROI Icon" width="76" /></div>
                                <div class="label">ROI in year one <?php output_roi_tooltip($block['results'], 'roi_tooltip', true); ?></div>
                                <div class="value-wrap font-weight-heavy text-primary"><span class="value"></span>%</div>
                            </div>
                        </div>
                        <div class="col-xs-6 roi-icon-result">
                            <div id="payback_period">
                                <div class="icon"><img src="<?= get_template_directory_uri(); ?>/dist/images/agent-assist-payback-icon.svg" alt="ROI Calendar Icon" width="60" style="padding: 9px 0" /></div>
                                <div class="label">Payback period <?php output_roi_tooltip($block['results'], 'payback_period_tooltip', true); ?></div>
                                <div class="value-wrap font-weight-heavy text-primary"><span class="value"></span> days</div>
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