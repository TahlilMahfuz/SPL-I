<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Appoint
                                            <?php  echo $row['servicetype'];?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="postuserlogin.php" method="post">

                                            <div class="form-group">
                                                <label for="appointuserservicetype">Service Type:</label>
                                                <input type="text" maxlength="20" class="form-control"
                                                    id="appointuserservicetype" name="appointuserservicetype"
                                                    aria-describedby="emailHelp"
                                                    value="<?php  echo $_POST['apointservicename'];?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="appointuserservicecost">Service cost:</label>
                                                <input type="text" maxlength="20" class="form-control"
                                                    id="appointuserservicecost" name="appointuserservicecost"
                                                    aria-describedby="emailHelp"
                                                    value="<?php  echo $row['servicecost'];?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="appointuserlocation">Location:</label>
                                                <input type="text" maxlength="20" class="form-control"
                                                    id="appointuserlocation" name="appointuserlocation"
                                                    aria-describedby="emailHelp">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="appointuserservice"
                                                    class="btn btn-success">Request</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>