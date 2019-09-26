<div class="box-header with-border">
    <h3 class="box-title"></h3>
</div>
<div class = "box-body">
    <table class="table pt10 table-bordered responsive-table">
        <thead>
            <tr>
                <th style="width:5%">#</th>
                <th style="width:40%">Name</th>
                <th style="width:10%">Code</th>
                <th style="width:45%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (!empty($country)) : foreach ($country as $c) :
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $c->name ?></td>
                        <td><?= $c->code ?></td> 
                        <td class="text-right">
                            <div class="checkbox">
                                <label>
                                    <?php if ($c->status == STATUS_ACTIVE) : ?>
                                        <input data-id="<?= $c->id ?>" class="c_sts" name="status" value="1" checked="" type="checkbox">   Mark this Country as Disable
                                    <?php else : ?>
                                        <input data-id="<?= $c->id ?>" class="c_sts" name="status" value="1" type="checkbox">   Mark this Country as Enable
                                    <?php endif; ?>
                                </label>
                            </div>
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