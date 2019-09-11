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
<div class="container-wrap blue-light-medium-gradient">
    <div class="container">
        <div class="row d-flex flex-wrap">
            <div class="col-xs-12 col-md-6 roi-input-col">
                <div class="col-inner">
                    <h2><?= $block['inputs']['title']; ?></h2>
                    <p><?= $block['inputs']['description']; ?></p>
                    <hr/>
                    <h3>About your team</h3>
                    <div class="form-group">
                        <label for="active_agents" class="d-block strong">Number of active live chat agents <?php output_roi_tooltip($block['inputs'], 'number_of_active_agents_tooltip'); ?></label>
                        <input id="active_agents" data-provide="slider" data-slider-id='active_agents_slider' type="text" data-slider-min="1" data-slider-ticks-snap-bounds="5" data-slider-lock-to-ticks="true" data-slider-ticks="[1, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]" data-slider-max="100" data-slider-step="5" data-slider-value="25" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
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
                                <input id="call_center_weeks_year" class="input-small" type="number" value="52" min="0" max="52" /> <small>weeks/year</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="agent_compensation" class="d-block strong">Average compensation per agent <?php output_roi_tooltip($block['inputs'], 'average_compensation_per_agent_tooltip'); ?></label>
                        <input id="agent_compensation" data-provide="slider" data-slider-id='agent_compensation_slider' type="text" data-slider-step="500" data-slider-min="10000" data-slider-max="100000" data-slider-step="1" data-slider-value="40000" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>

                    <hr />

                    <h3>Your chats</h3>
                    <div class="form-group">
                        <label for="chat_length" class="d-block strong">Average length of chat <?php output_roi_tooltip($block['inputs'], 'avarage_length_of_chat_tooltip'); ?></label>
                        <input id="chat_length" data-provide="slider" data-slider-id='chat_length_slider' type="text" data-slider-min="1" data-slider-max="30" data-slider-step="1" data-slider-value="6" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="form-group">
                        <label for="concurrent_chats" class="d-block strong">Number of concurrent chats per agent <?php output_roi_tooltip($block['inputs'], 'number_of_concurrent_chats_per_agent_tooltip'); ?></label>
                        <input id="concurrent_chats" data-provide="slider" data-slider-id='concurrent_chats_slider' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="3" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                    </div>
                    <div class="form-group">
                        <label for="chat_volume_growth" class="d-block strong">Anticipated chat volume growth <?php output_roi_tooltip($block['inputs'], 'anticipated_chat_volume_growth_tooltip'); ?></label>
                        <?php
                        if (array_key_exists('anticipated_chat_volume_growth_intro', $block['inputs']) && !empty($block['inputs']['anticipated_chat_volume_growth_intro'])) {
                            echo '<p>'.$block['inputs']['anticipated_chat_volume_growth_intro'].'</p>';
                        }
                        ?>
                        <input id="chat_volume_growth" data-provide="slider" data-slider-id='chat_volume_growth_slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="20" data-slider-tooltip-position="bottom" data-slider-tooltip="always" />
                        <small class="x-small">While chatbot costs are variable (based on chat volume), human agent costs are fixed. This is why you will notice a decline in ROI at certain growth levels. When your human team hits capacity you need to hire another agent, but you may not use all the new capacity right away, leaving you room for chat volume growth and declining average per-chat costs until you reach capacity again (picture a staircase-shaped graph). With a chatbot, your costs increase in a straight line.</small>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 roi-results-col bg-blue-medium">
                <div class="col-inner">
                    <h2><?= $block['results']['title']; ?></h2>
                    <p><?= $block['results']['description']; ?></p>
                    <hr/>
                    <h5 class="">Your team's chat capacity: <?php output_roi_tooltip($block['results'], 'your_teams_chat_capacity_tooltip'); ?></h5>
                    <div class="row capacity-results d-flex">
                        <div class="col-xs-6 text-center item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/live-chat-agent.png" alt="Live Chat Agent Icon" width="40" /><br/>
                            Before<br/>
                            <span id="current_chat_capacity" class="value  font-weight-heavy">XXXX</span>
                            <br/>
                            chats
                        </div>
                        <div class="col-xs-6 text-center item">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/live-chat-agent.png" alt="Live Chat Agent Icon" width="40" /> <img src="<?= get_template_directory_uri(); ?>/dist/images/live-chat-bot.png" alt="Live Chatbot Icon" width="40" /> <br/>
                            After<br/>
                            <span id="future_chat_capacity" class="value  font-weight-heavy">XXXX</span>
                            <br/>
                            chats
                        </div>
                    </div>

                    <hr />


                    <h5 class="">To meet this new demand, you will need: <?php output_roi_tooltip($block['results'], 'new_demand_tooltip'); ?></h5>
                    <div class="row capacity-results d-flex">
                        <div class="col-xs-5 text-center item">
                        <img src="<?= get_template_directory_uri(); ?>/dist/images/live-chat-agent.png" alt="Live Chat Agent Icon" width="40" /><br/>
                            <span class="value future_additional_agents font-weight-heavy">XXXX</span>
                            <br/>
                            New agents,<br/>for a total of <span id="future_agent_total">XX</span>
                        </div>
                        <div class="col-xs-2 text-center item comparison d-flex align-items-center">
                            <span class="inner font-weight-heavy">or</span>
                        </div>
                        <div class="col-xs-5 text-center item">
                        <img src="<?= get_template_directory_uri(); ?>/dist/images/live-chat-bot.png" alt="Live Chat Bot Icon" width="40" /><br/>
                            <span id="future_team_bots" class="value  font-weight-heavy">XXXX</span>
                            <br/>
                            Comm100 Chatbot with virtually unlimited capacity
                        </div>
                    </div>
                    <hr/>
                    <h5 class="">Your total estimated costs are:</h5>
                    <div class="estimate-costs-legend">
                        <div class="item">
                            <span class="legend-colour" style="background: #3dc4ff;"></span>
                            Labor costs
                        </div>
                        <div class="item">
                            <span class="legend-colour" style="background: #0091d1;"></span>
                            Live Chat system costs
                        </div>
                        <div class="item">
                            <span class="legend-colour" style="background: #9fdd09;"></span>
                            Chatbot system costs
                        </div>
                    </div>
                    <div class="roi-results">
                        <div class="roi-result">
                            <div id="live_chat_cost_bar" class="roi-bar-chart">
                                <div class="bar">
                                    <div id="live_chat_system_cost_bar" class="bar-segment" style="background: #0091d1;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                    <div id="live_chat_labour_cost_bar" class="bar-segment" style="background: #3dc4ff;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                </div>
                                <div class="label">
                                    <small>Anticipated cost with <span class="future_additional_agents">XX</span> new agents</small>
                                    <div id="total_livechat_costs" class="font-weight-heavy">$<span class="value">XXXXX</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="roi-result-comparison font-weight-heavy d-flex">
                            <div class="inner text-center">or</div>
                        </div>
                        <div class="roi-result">
                            <div id="live_chatbot_costs_bar" class="roi-bar-chart">
                                <div class="bar">
                                    <div id="chatbot_cost_bar" class="bar-segment" style="background: #9fdd09;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                    <div id="chatbot_livechat_system_cost_bar" class="bar-segment" style="background: #0091d1;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                    <div id="chatbot_livechat_labour_cost_bar" class="bar-segment" style="background: #3dc4ff;">
                                        <div class="segment_total">$<span class="segment_value"></span></div>
                                    </div>
                                </div>
                                <div class="label">
                                    <small>Anticipated cost current team size plus Chatbot</small>
                                    <div id="total_live_chatbot_costs" class="font-weight-heavy">$<span class="value">XXXXX</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="bar-chart-totals text-center">
                        Adding an AI-powered chatbot as a customer engagement channel will generate a savings of<br/>
                        <h4>$<span id="adding_ai_savings"></span> per year</h4>
                    </div>
                    <hr/>
                    <div class="roi-results row text-center">
                        <div class="col-xs-6 roi-icon-result">
                            <div id="one_year_roi">
                                <div class="icon"><img src="<?= get_template_directory_uri(); ?>/dist/images/chatbot-roi.png" alt="ROI Icon" /></div>
                                <div class="label">ROI in year one <?php output_roi_tooltip($block['results'], 'roi_tooltip'); ?></div>
                                <div class="value-wrap font-weight-heavy"><span class="value"></span>%</div>
                            </div>
                        </div>
                        <div class="col-xs-6 roi-icon-result">
                            <div id="payback_period">
                                <div class="icon"><img src="<?= get_template_directory_uri(); ?>/dist/images/chatbot-payback-period.png" alt="ROI Calendar Icon" /></div>
                                <div class="label">Payback period <?php output_roi_tooltip($block['results'], 'payback_period_tooltip'); ?></div>
                                <div class="value-wrap font-weight-heavy"><span class="value"></span> days</div>
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