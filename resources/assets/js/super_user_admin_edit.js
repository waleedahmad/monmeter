class Admin{

    constructor(){

        this.location_name = $("#loc-name");
        this.location_date = $("#loc-date");
        this.name = $("#name");
        this.job_position = $("#job-position");
        this.email = $("#email");
        this.password = $("#password");
        this.static_ip = $("#static-ip");
        this.mac_address = $("#mac");
        this.user_id = $("#user-id");

        $( "#loc-date" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $(".location-form form").on('submit', {context : this}, this.validateForm);
        $(".edit-location-form form").on('submit', {context : this}, this.validateEditForm);
        $("#loc-name, #loc-date, #name," +
            " #job-position, #email, #password, " +
            "#static-ip, #mac").on('keyup change', function(){
            $(this).siblings(".invalid-input-tooltip").remove();
            $(this).removeClass('invalid')
        });
        
        $(".remove-location").on('click', {context : this}, this.confirmRemove);
    }
    
    confirmRemove(e){
        e.preventDefault();
        var _this = e.data.context,
            id = $(this).attr('data-id');
        console.log(id);

        var $overlay = `<div class="overlays">
                        <div class="rm-loc-overlay">
                            <span class="close">
                                <?xml version="1.0" encoding="utf-8"?>
                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                <svg version="1.1" id="close-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 9.1 9.1" enable-background="new 0 0 9.1 9.1" xml:space="preserve">
                                <g>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M9.1,4.6c0,2.5-2.1,4.6-4.6,4.6C2,9.1,0,7,0,4.5C0,2,2.1,0,4.6,0
                                        C7.1,0,9.1,2.1,9.1,4.6z M0.4,4.6c0,2.3,1.9,4.2,4.2,4.2c2.3,0,4.2-1.9,4.2-4.2c0-2.3-1.9-4.2-4.2-4.2C2.3,0.4,0.4,2.3,0.4,4.6z"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M4.6,4.3C4.7,4.1,4.8,4,5,3.8c0.3-0.3,0.6-0.6,0.9-0.9
                                        c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0.2,0,0.3,0c0.1,0.1,0.1,0.2,0,0.2c0,0,0,0.1-0.1,0.1C5.8,3.6,5.3,4.1,4.9,4.5c0,0-0.1,0-0.1,0.1
                                        c0,0,0.1,0.1,0.1,0.1c0.4,0.4,0.8,0.8,1.3,1.3c0,0,0.1,0.1,0.1,0.1c0.1,0.1,0,0.2,0,0.2C6.2,6.3,6.1,6.3,6,6.3c0,0-0.1,0-0.1-0.1
                                        C5.5,5.8,5.1,5.3,4.6,4.9c0,0,0,0-0.1-0.1c0,0-0.1,0-0.1,0.1C4.1,5.3,3.6,5.8,3.2,6.2c0,0,0,0-0.1,0.1C3.1,6.3,3,6.3,2.9,6.2
                                        C2.8,6.2,2.8,6,2.9,5.9c0.4-0.4,0.9-0.9,1.3-1.3c0,0,0,0,0.1-0.1c0,0,0-0.1-0.1-0.1C3.8,4.1,3.4,3.6,2.9,3.2c0,0,0,0-0.1-0.1
                                        c-0.1-0.1,0-0.2,0-0.2c0.1-0.1,0.2-0.1,0.2,0c0,0,0.1,0.1,0.1,0.1C3.6,3.4,4.1,3.8,4.6,4.3C4.5,4.2,4.5,4.2,4.6,4.3z"/>
                                </g>
                                </svg>
                            </span>
                
                            <div class="icon">
                                <?xml version="1.0" encoding="utf-8"?>
                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                <svg version="1.1" id="header-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 25.9 25.9" enable-background="new 0 0 25.9 25.9" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path fill="#FFFFFF" d="M10.3,17.7c0-0.2,0.1-0.5,0.2-0.9l1.3-4.9c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2c0-0.3-0.1-0.5-0.3-0.5
                                                c-0.2-0.1-0.5-0.1-1-0.1v-0.6c0.4,0,1-0.1,1.8-0.2c0.8-0.1,1.3-0.2,1.6-0.2l0.9-0.2L13.3,16c-0.1,0.5-0.2,0.9-0.3,1.1
                                                c-0.1,0.5-0.2,0.9-0.2,1c0,0.2,0,0.3,0.1,0.3c0.1,0,0.1,0.1,0.2,0.1c0.2,0,0.5-0.2,0.8-0.6c0.3-0.4,0.6-0.8,0.9-1.2l0.5,0.3
                                                c-0.7,1-1.3,1.7-1.6,2.1c-0.6,0.6-1.3,0.9-2,0.9c-0.4,0-0.8-0.1-1.1-0.4c-0.3-0.2-0.5-0.6-0.5-1.1C10.1,18.3,10.2,18.1,10.3,17.7z
                                                 M15.4,5.3c0.3,0.3,0.4,0.6,0.4,1c0,0.4-0.1,0.7-0.4,1c-0.3,0.3-0.6,0.4-1,0.4c-0.4,0-0.7-0.1-1-0.4c-0.3-0.3-0.4-0.6-0.4-1
                                                c0-0.4,0.1-0.7,0.4-1c0.3-0.3,0.6-0.4,1-0.4C14.7,4.9,15.1,5.1,15.4,5.3z"/>
                                        </g>
                                        <g>
                                            <path fill="#FFFFFF" d="M13,0C5.8,0,0,5.8,0,13c0,7.2,5.8,13,13,13s13-5.8,13-13C25.9,5.8,20.1,0,13,0z M13,24
                                                C6.9,24,1.9,19.1,1.9,13c0-6.1,5-11.1,11.1-11.1S24,6.9,24,13C24,19.1,19.1,24,13,24z"/>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                
                            <div class="heading">
                                <p class="header">Remove location confirmation</p>
                                <p class="description">
                                   Once removed, all data on this linked node will be deleted on the server
                                </>
                            </div>
                
                            <div class="confirm-box">
                                <div class="confirm-dialogue">
                                    <div class="confirm-icon" data-status="false">
                                    <?xml version="1.0" encoding="utf-8"?>
                                    <!-- Generator: Adobe Illustrator 18.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                        <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                        <svg version="1.1" id="confirm-checkbox" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 25.9 25.9" enable-background="new 0 0 25.9 25.9" xml:space="preserve">
                                        <g>
                                            <path fill="#C1354E" d="M13.6,1.9C7.3,1.9,2.2,7.1,2.2,13.4s5.1,11.4,11.4,11.4s11.4-5.1,11.4-11.4S19.9,1.9,13.6,1.9z M13.6,21.5
                                                c-4.5,0-8.1-3.6-8.1-8.1c0-4.5,3.6-8.1,8.1-8.1c4.5,0,8.1,3.6,8.1,8.1C21.7,17.9,18.1,21.5,13.6,21.5z"/>
                                            <path fill="#C1354E" d="M13.6,18.5c-2.8,0-5.1-2.3-5.1-5.1s2.3-5.1,5.1-5.1c2.8,0,5.1,2.3,5.1,5.1S16.4,18.5,13.6,18.5z"/>
                                            <path fill="#C1354E" d="M13.6,8.3c-2.8,0-5.1,2.3-5.1,5.1s2.3,5.1,5.1,5.1c2.8,0,5.1-2.3,5.1-5.1S16.4,8.3,13.6,8.3z"/>
                                        </g>
                                        </svg>
                
                                    </div>
                
                                    <div class="text">
                                        I have read and understand the above information
                                    </div>
                                </div>
                
                                <button class="delLocBtn" data-id="${id}">
                                    Remove >
                                </button>
                            </div>
                        </div>
                    </div>`;

        $(".wrapper").append($overlay);
        $(".rm-loc-overlay #close-icon").on('click', function(){
            $(".overlays").remove();
        });

        $(".rm-loc-overlay .confirm-icon").on('click', function(){
            var status = $(this).attr('data-status');
            if(status === "true"){
                $(this).removeClass('ticked');
                $(this).attr('data-status', false);

                $(".rm-loc-overlay .delLocBtn").off('click').css({
                    'cursor' : 'not-allowed'
                });;

            }

            if(status === "false"){
                $(this).addClass('ticked');
                $(this).attr('data-status', true);
                

                $(".rm-loc-overlay .delLocBtn").on('click', function(){
                    var id = $(this).attr('data-id');
                    
                    $.ajax({
                        url : '/dashboard/manage/users/remove',
                        type : 'POST',
                        data : {
                            id : id,
                            _token : $("meta[name=_token]").attr('content')
                        },
                        success :  function(res){
                            if(res){
                                $(".remove-location[data-id="+id+"]").parents('tr').slideUp().remove();
                                $(".overlays").remove();
                            }
                        }
                    })
                }).css({
                    'cursor' : 'pointer'
                });
            }
        });
    }

    /**
     * Get Location
     * @returns {*}
     */
    getLocation(){
        return $.trim(this.location_name.val());
    }

    /**
     * Get Date
     * @returns {*}
     */
    getDate(){
        return $.trim(this.location_date.val());
    }

    /**
     * Get Name
     * @returns {*}
     */
    getName(){
        return $.trim(this.name.val());
    }

    /**
     * Get Job Position
     * @returns {*}
     */
    getJobPosition(){
        return $.trim(this.job_position.val());
    }

    /**
     * Get Email
     * @returns {*}
     */
    getEmail(){
        return $.trim(this.email.val());
    }

    /**
     * Get Password
     * @returns {*}
     */
    getPassword(){
        return $.trim(this.password.val());
    }

    /**
     * Get Static IP
     * @returns {*}
     */
    getStaticIP(){
        return $.trim(this.static_ip.val());
    }

    /**
     * Get mac address
     * @returns {*}
     */
    getMacAddress(){
        return $.trim(this.mac_address.val());
    }

    getOldEmail(){
        return $.trim(this.email.attr('data-old-email'));
    }
    
    getUserId(){
        return $.trim(this.user_id.val());
    }

    /**
     * Validate form
     * @returns {*}
     */
    allValid(){
        return (this.getLocation().length &&
        this.getDate().length &&
        this.getName().length &&
        this.getJobPosition().length &&
        this.getEmail().length &&
        this.getPassword().length &&
        this.getStaticIP().length &&
        this.getMacAddress().length);
    }

    /**
     * Create a new admin
     * @param _this
     */
    createAdmin(_this){
        $.ajax({
            type : 'POST',
            url : '/dashboard/manage/users/create',
            data : {
                loc_name : _this.getLocation(),
                date : _this.getDate(),
                name : _this.getName(),
                job_position : _this.getJobPosition(),
                email : _this.getEmail(),
                password : _this.getPassword(),
                static_ip : _this.getStaticIP(),
                mac : _this.getMacAddress(),
                _token : $("meta[name=_token]").attr('content')
            },
            success : function(res){
                if(res){
                    window.location = '/dashboard/manage/users/location-list';
                }
            }
        });
    }
    
    updateAdmin(_this){
        $.ajax({
            type : 'POST',
            url : '/dashboard/manage/users/update',
            data : {
                user_id : _this.getUserId(),
                old_email : _this.getOldEmail(),
                loc_name : _this.getLocation(),
                date : _this.getDate(),
                name : _this.getName(),
                job_position : _this.getJobPosition(),
                email : _this.getEmail(),
                password : _this.getPassword(),
                static_ip : _this.getStaticIP(),
                mac : _this.getMacAddress(),
                _token : $("meta[name=_token]").attr('content')
            },
            success : function(res){
                if(res){
                    window.location = '/dashboard/manage/users/location-list';
                }
            }
        });
    }

    /**
     * Checks for duplicate emails
     * @param email
     * @param _this
     */
    validateEmail(email, _this, action){
        $.ajax({
            type : 'GET',
            url : '/dashboard/manage/users/exists',
            data : {
                email : email
            },
            success : function(user){
                if(action === 'new'){
                    if(user){
                        _this.email.after(_this.errorDOM('Email already exist', 'password')).addClass('invalid');
                    }else{
                        _this.createAdmin(_this);
                    }
                }

                if(action === 'edit'){
                    if(user){
                        _this.email.after(_this.errorDOM('Email already exist', 'password')).addClass('invalid');
                    }else{
                        _this.updateAdmin(_this);
                    }
                }
            }
        });
    }

    /**
     * Validate form fields
     * @param e
     */
    validateForm(e){
        var _this = e.data.context;
        $(".invalid-input-tooltip").remove();
        e.preventDefault();

        if(_this.allValid()){
            if(_this.getPassword().length > 6){
                _this.validateEmail(_this.getEmail(), _this, 'new');
            }else{
                _this.password.after(_this.errorDOM('6 characters minimum', 'password')).addClass('invalid');
            }
        }else{

            if(!_this.getLocation().length){
                _this.location_name.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getDate().length){
                _this.location_date.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getName().length){
                _this.name.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getJobPosition().length){
                _this.job_position.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getEmail().length){
                _this.email.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getPassword().length){
                _this.password.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getStaticIP().length){
                _this.static_ip.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getMacAddress().length){
                _this.mac_address.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }
        }
    }

    /**
     * Validate Edit form
     * @param e
     */
    validateEditForm(e){
        var _this = e.data.context;
        $(".invalid-input-tooltip").remove();
        e.preventDefault();

        if(_this.allValid()){
            if(_this.getPassword().length > 6){
                if(_this.getOldEmail() != _this.getEmail()){
                    _this.validateEmail(_this.getEmail(), _this, 'edit');
                }else{
                    _this.updateAdmin(_this);
                }
            }else{
                _this.password.after(_this.errorDOM('6 characters minimum','password')).addClass('invalid');
            }
        }else{

            if(!_this.getLocation().length){
                _this.location_name.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getDate().length){
                _this.location_date.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getName().length){
                _this.name.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getJobPosition().length){
                _this.job_position.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getEmail().length){
                _this.email.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getPassword().length){
                _this.password.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getStaticIP().length){
                _this.static_ip.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getMacAddress().length){
                _this.mac_address.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }
        }
    }

    /**
     * Generates Error DOM
     * @param message
     * @param type
     * @returns {string}
     */
    errorDOM(message, type) {

        if(type === 'invalid'){
            return `<?xml version="1.0" encoding="utf-8"?>
                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                <svg version="1.1" class="invalid-input-tooltip" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 168.7 42" enable-background="new 0 0 168.7 42" xml:space="preserve">
                <rect x="10" fill="#C1354E" width="159" height="42"/>
                <g>
                    <g>
                        <path fill="#FFFFFF" d="M36.4,25.9c0-0.2,0.1-0.5,0.2-0.9l1.3-4.8c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2c0-0.3-0.1-0.5-0.3-0.5
                            c-0.2-0.1-0.5-0.1-1-0.1v-0.6c0.4,0,1-0.1,1.7-0.2c0.8-0.1,1.3-0.2,1.6-0.2l0.9-0.2l-1.7,6.1c-0.1,0.5-0.2,0.9-0.3,1.1
                            c-0.1,0.5-0.2,0.8-0.2,1c0,0.2,0,0.3,0.1,0.3c0.1,0,0.1,0.1,0.2,0.1c0.2,0,0.5-0.2,0.8-0.6c0.3-0.4,0.6-0.8,0.8-1.2l0.5,0.3
                            c-0.7,1-1.2,1.7-1.6,2.1c-0.6,0.6-1.3,0.9-1.9,0.9c-0.4,0-0.7-0.1-1.1-0.4c-0.3-0.2-0.5-0.6-0.5-1.1
                            C36.3,26.5,36.4,26.3,36.4,25.9z M41.5,13.8c0.3,0.3,0.4,0.6,0.4,1c0,0.4-0.1,0.7-0.4,1c-0.3,0.3-0.6,0.4-1,0.4
                            c-0.4,0-0.7-0.1-1-0.4c-0.3-0.3-0.4-0.6-0.4-1c0-0.4,0.1-0.7,0.4-1c0.3-0.3,0.6-0.4,1-0.4C40.8,13.3,41.2,13.5,41.5,13.8z"/>
                    </g>
                    <g>
                        <path fill="#FFFFFF" d="M39.1,8.5c-7,0-12.8,5.7-12.8,12.8c0,7,5.7,12.8,12.8,12.8s12.8-5.7,12.8-12.8
                            C51.8,14.2,46.1,8.5,39.1,8.5z M39.1,32.1c-6,0-10.9-4.9-10.9-10.9c0-6,4.9-10.9,10.9-10.9c6,0,10.9,4.9,10.9,10.9
                            C50,27.3,45.1,32.1,39.1,32.1z"/>
                    </g>
                </g>
                <polygon fill="#D2304F" points="-0.2,20.7 4.9,17.6 10,14.5 10,20.7 10,27 4.9,23.9 "/>
                <text transform="matrix(1 0 0 1 60.6667 24.3333)" fill="#FFFFFF" >${message}</text>
                </svg>
                `;
        }

        if(type === 'password'){
            return `<?xml version="1.0" encoding="utf-8"?>
                    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                    <svg version="1.1" class="invalid-input-tooltip password" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 239.5 42" enable-background="new 0 0 239.5 42" xml:space="preserve">
                    <rect x="10" fill="#C1354E" width="229" height="42"/>
                    <g>
                        <g>
                            <path fill="#FFFFFF" d="M36.4,25.9c0-0.2,0.1-0.5,0.2-0.9l1.3-4.8c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2c0-0.3-0.1-0.5-0.3-0.5
                                c-0.2-0.1-0.5-0.1-1-0.1v-0.6c0.4,0,1-0.1,1.7-0.2c0.8-0.1,1.3-0.2,1.6-0.2l0.9-0.2l-1.7,6.1c-0.1,0.5-0.2,0.9-0.3,1.1
                                c-0.1,0.5-0.2,0.8-0.2,1c0,0.2,0,0.3,0.1,0.3c0.1,0,0.1,0.1,0.2,0.1c0.2,0,0.5-0.2,0.8-0.6c0.3-0.4,0.6-0.8,0.8-1.2l0.5,0.3
                                c-0.7,1-1.2,1.7-1.6,2.1c-0.6,0.6-1.3,0.9-1.9,0.9c-0.4,0-0.7-0.1-1.1-0.4c-0.3-0.2-0.5-0.6-0.5-1.1
                                C36.3,26.5,36.4,26.3,36.4,25.9z M41.5,13.8c0.3,0.3,0.4,0.6,0.4,1c0,0.4-0.1,0.7-0.4,1c-0.3,0.3-0.6,0.4-1,0.4
                                c-0.4,0-0.7-0.1-1-0.4c-0.3-0.3-0.4-0.6-0.4-1c0-0.4,0.1-0.7,0.4-1c0.3-0.3,0.6-0.4,1-0.4C40.8,13.3,41.2,13.5,41.5,13.8z"/>
                        </g>
                        <g>
                            <path fill="#FFFFFF" d="M39.1,8.5c-7,0-12.8,5.7-12.8,12.8c0,7,5.7,12.8,12.8,12.8s12.8-5.7,12.8-12.8
                                C51.8,14.2,46.1,8.5,39.1,8.5z M39.1,32.1c-6,0-10.9-4.9-10.9-10.9c0-6,4.9-10.9,10.9-10.9c6,0,10.9,4.9,10.9,10.9
                                C50,27.3,45.1,32.1,39.1,32.1z"/>
                        </g>
                    </g>
                    <polygon fill="#D2304F" points="-0.2,20.7 4.9,17.6 10,14.5 10,20.7 10,27 4.9,23.9 "/>
                    <text transform="matrix(1 0 0 1 60.6667 24.3333)" fill="#FFFFFF" font-size="14">${message}</text>
                    </svg>`
        }
    }
}

new Admin();