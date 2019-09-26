<div class="box-header with-border">
    <form name="search" method="get">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="app_id">Applicant Id</label>
                    <input class="form-control" value="<?= (!empty($this->input->get('app_id'))) ? $this->input->get('app_id') : '' ?>" name="app_id" placeholder="Applicant Id" type="text">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="name">Applicant Name</label>
                    <input class="form-control" value="<?= (!empty($this->input->get('name'))) ? $this->input->get('name') : '' ?>" name="name" placeholder="Applicant Name" type="text">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="passport_no">Passport No</label>
                    <input name="passport_no" value="<?= (!empty($this->input->get('passport_no'))) ? $this->input->get('passport_no') : '' ?>" class="form-control" placeholder="Passport No" type="text">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" value="<?= (!empty($this->input->get('email'))) ? $this->input->get('email') : '' ?>" class="form-control" placeholder="Email" type="email">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input name="phone" value="<?= (!empty($this->input->get('phone'))) ? $this->input->get('phone') : '' ?>" class="form-control" placeholder="Phone" type="text">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="birth_country">Country of Birth</label>
                    <select name="birth_country" class="form-control">
                        <option value="">Select Country</option>
                        <?php foreach ($getCounrty as $counrty) : ?>
                            <option <?= ($counrty->code == $this->input->get('birth_country')) ? 'selected=""' : '' ?> value="<?= $counrty->code ?>" title="<?= $counrty->name ?>"><?= $counrty->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="app_status">Application Status</label>
                    <select name="app_status" class="form-control">
                        <option value="">Select Application Status</option> 
                        <option <?= ('payment_pending' == $this->input->get('app_status')) ? 'selected=""' : '' ?> value="payment_pending">Payment Pending</option>
                        <option <?= ('pdnc' == $this->input->get('app_status')) ? 'selected=""' : '' ?> value="pdnc">Payment Done & Not Closed</option>
                        <option <?= ('pfnc' == $this->input->get('app_status')) ? 'selected=""' : '' ?> value="pfnc">Payment Failed & Not Closed</option>
                        <option <?= ('closed' == $this->input->get('app_status')) ? 'selected=""' : '' ?> value="closed">Closed</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="  text-right">
            <a class="btn btn-default" href="<?= base_url('admin/home/applicationDetails') ?>">Reset</a>
            <button class="btn bg-blue ml15" type="submit">Search Application</button>
        </div>
    </form>
</div>
<div class = "box-body">
    <?= $this->paginator->dispaly_page_record_ipp() ?> 
    <div class="table-responsive">
        <table class="table pt10 table-bordered responsive-table">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 30%">Application</th>
                    <th style="width: 20%">Applicant</th>
                    <th style="width: 25%">Passport</th>
                    <th style="width: 20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = $page + 1;
                if (!empty($application)) : foreach ($application as $app) :
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <a href="<?= base_url(); ?>admin/home/appDetails/<?= $app->app_id ?>" >
                                    <b>Application ID : <?= $app->app_id ?></b>
                                </a><br/>
                                <b>Application Type : </b><?= $app->app_type_name ?><br/>
                                <b>Visa : </b><?= $app->visa_type_name ?> (<?= $app->visa_validitiy ?> Days)<br/>
                                <b>Application Time : </b><?= date('d-m-Y H:i:s', strtotime($app->date_created)) ?><br/>
                                <b>Date of Arrival : </b><?= $app->expected_date_arrival ?>
                            </td>
                            <td>
                                <b>Name :</b><?= $app->fname ?> <?= $app->lname ?><br/>
                                <b>Email : </b><?= $app->email ?><br/>
                                <b>Phone : </b><?= $app->phone ?><br/>
                                <b>Nationality : </b><?= country_name(NULL,$app->nationality) ?> <br/>
                                <b>Date of Birth : </b><?= $app->dob ?><br/>
                                <b>Sex : </b><?= $app->sex ?>
                            </td>
                            <td>
                                <b>Passport Type : </b><?= $app->passport_type ?><br/>
                                <b>Passport No : </b><?= $app->passport_no ?><br/>
                                <b>Port Of Arrival : </b><?= port_name($app->portofarrival) ?>
                            </td>
                            <td class="text-right">
                                <?php
                                if ($app->application_status == 1) {
                                    echo 'Payment Pending';
                                } else if (($app->application_status == 2) && ($app->payment_status == 1)) {
                                    ?>
                                    <div class="checkbox">
                                        <label><input data-app_id="<?= $app->app_id ?>" id="app_status" name="app_status" value="1" type="checkbox"> Close Application</label>
                                    </div>
                                    <?php
                                } else if ($app->payment_status == 2) {
                                    echo 'Payment Faild';
                                } else if ($app->application_status == 3) {
                                    echo 'Closed';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="box-footer clearfix">
    <?= $this->paginator->display_jump_menu_pages() ?>
</div>
