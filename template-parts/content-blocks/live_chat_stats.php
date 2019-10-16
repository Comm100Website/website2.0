<div id="stats-step1" class="step-container container">
    <div class="bg-light-grey statistics">
        <div class="row step-header">
            <div class="col-xs-12">
                <h3>How does your live chat data stack up?</h3>
                <p>In total, we analysed data from over 45 million chats to bring you the most update-to-date live chat statistics and help inform your customer engagement strategy.</p>
                <p>Below are the overall live chat data benchmarks from our annual Live Chat Benchmark 2019 report. Input your industry and team size to get a personalized look into how you compare to companies of a similar size and space.</p>
            </div>
        </div>
        <form id="stats-form" class="form-inline">
            <div class="row step-content">
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <div class="form-group">
                        <label for="industry">What is your industry?</label>
                        <select name="industry" id="industry" required>
                            <option value="">- Choose an industry -</option>
                            <option value="Banking and Financial Services">Banking and Financial Services</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Government">Government</option>
                            <option value="eCommerce">eCommerce</option>
                            <option value="Manufacturing">Manufacturing</option>
                            <option value="Technology">Technology</option>
                            <option value="Recreation">Recreation</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="num_agents">How many agents in your team?</label>
                        <input id="num_agents" name="num_agents" class="input-small" placeholder="Type here" type="number" min="1" max="100" required />
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 text-md-right">
                    <button type="submit" class="btn btn-xlg c-btn-border-2x c-theme-btn">Update the numbers</button>
                </div>
            </div>
        </form>
        <div class="row step-content d-flex flex-wrap">
            <div class="col-xs-12 col-sm-6 col-md-4 stat-wrap">
                <div id="avg-rating" class="statistic">
                    <div class="value-wrap">
                        <span class="value">4.20</span>
                    </div>
                    <div class="title">Average rating</div>
                    <div class="description">Ratings on a scale of 1 to 5</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 stat-wrap">
                <div id="avg-satisfaction" class="statistic">
                    <div class="value-wrap">
                        <span class="value">83.10</span>%
                    </div>
                    <div class="title">Average<br/>customer satisfaction</div>
                    <div class="description">Percentage of ratings that are above 3.00/5.00</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 stat-wrap">
                <div id="avg-chats-month" class="statistic">
                    <div class="value-wrap">
                        <span class="value">3,290</span>
                    </div>
                    <div class="title">Average number of chats per month</div>
                    <div class="description">Does not include offline messages</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 stat-wrap">
                <div id="mobile-chats" class="statistic">
                    <div class="value-wrap">
                        <span class="value">51.68</span>%
                    </div>
                    <div class="title">Mobile chats</div>
                    <div class="description">Percentage of total number of chats</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 stat-wrap">
                <div id="avg-wait-time" class="statistic">
                    <div class="value-wrap">
                        <span class="value">48 sec</span>
                    </div>
                    <div class="title">Average wait time</div>
                    <div class="description">Average time a visitor is waiting before connecting to an agent</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 stat-wrap">
                <div id="avg-chat-length" class="statistic">
                    <div class="value-wrap">
                        <span class="value">11 min<br/>53 sec</span>
                    </div>
                    <div class="title">Average chat length</div>
                    <div class="description">Average duration from when a visitor connects to wrap-up</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="stats-result-form" class="container section-footer">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <img src="<?= $block['report_form']['form_thumbnail']['url']; ?>" alt="<?= get_the_title(); ?>" />
        </div>
        <div class="col-xs-12 col-md-4">
            <?php
                echo '<h2>'.$block['report_form']['title'].'</h2>';
                echo '<p>'.$block['report_form']['description'].'</p>';
            ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $block['report_form']['form_code']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <hr/>
        </div>
    </div>
</div>


<div class="c-content-box c-size-md c-content-box--bg"><div class="container"><div class="row"><div class="col-sm-12 callToAction callToAction--requestdemo"><h3>Ready to learn more?</h3><p class="subtitle">Request a personalized demo today.</p><a class="btn btn-xlg c-theme-btn" href="/requestdemo/" target="">Book demo</a></div></div></div></div>