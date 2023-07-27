                        <!-- Footer Start-->
                        <div id="admin-footer">                                
                                <span>&copy; copyright <span id="curYear"></span> - Created By techsumanta</span>                            
                        </div>
                        <!-- Footer End-->
                    </div>
                    <!-- Content End-->
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/admin_actions.js" type="text/javascript"></script>
        <script src="js/jquery-te-1.4.0.min.js" type="text/javascript"></script>   
        <!-- https://jqueryte.com/ -->
        <!-- <script>
            $('.product_description').jqte({
                link: false,
                unlink: false,
                color: false,
                source: false,
            });
        </script> -->
        <script>
            let date = new Date();
            let year = date.getFullYear();
            document.getElementById("curYear").innerHTML = year;
        </script>
    </body>
</html>
