class ssuUser{

    constructor(){

        this.email = $("#email");
        this.password = $("#password");
        this.confirm_password = $("#password-confirm");

        $(".manage-super-user .add-user-form form").on('submit', {context : this}, this.validateForm);
        $(".manage-super-user .edit-user-form form").on('submit', {context : this}, this.validateEditForm);
        $("#email, #password, #password-confirm").on('keyup change', function(){
            $(this).siblings(".invalid-input-tooltip").remove();
            $(this).removeClass('invalid');
        });
    }

    /**
     * Validate form fields
     * @param e
     */
    validateForm(e){
        e.preventDefault();
        var _this = e.data.context;
        $(".invalid-input-tooltip").remove();

        if(_this.allValid()){
            if(_this.getPassword().length > 6){
                if(_this.getPassword() === _this.getConfirmPassword()) {
                    _this.validateEmail(_this.getEmail(), _this, 'new');
                }else{
                    _this.password.after(_this.errorDOM("Passwords didn't match", 'password')).addClass('invalid');
                }
            }else{
                _this.password.after(_this.errorDOM('6 characters minimum', 'password')).addClass('invalid');
            }
        }else{

            if(!_this.getEmail().length){
                _this.email.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getPassword().length){
                _this.password.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getConfirmPassword().length){
                _this.confirm_password.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }


        }
    }
    
    validateEditForm(e){
        e.preventDefault();
        var _this = e.data.context;
        $(".invalid-input-tooltip").remove();

        if(_this.allValid()){
            if(_this.getPassword().length > 6){
                if(_this.getPassword() === _this.getConfirmPassword()) {
                    //
                    
                    if(_this.getOldEmail() != _this.getEmail()){
                        _this.validateEmail(_this.getEmail(), _this, 'edit');
                    }else{
                        _this.updateSuperUser(_this);
                    }
                }else{
                    _this.password.after(_this.errorDOM("Passwords didn't match", 'password')).addClass('invalid');
                }
            }else{
                _this.password.after(_this.errorDOM('6 characters minimum', 'password')).addClass('invalid');
            }
        }else{

            if(!_this.getEmail().length){
                _this.email.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getPassword().length){
                _this.password.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getConfirmPassword().length){
                _this.confirm_password.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }


        }
    }

    /**
     * Checks for duplicate emails
     * @param email
     * @param _this
     */
    validateEmail(email, _this, action){
        $.ajax({
            type : 'GET',
            url : '/dashboard/manage/super-users/exists',
            data : {
                email : email
            },
            success : function(user){
                if(action === 'new'){
                    if(user){
                        _this.email.after(_this.errorDOM('Email already exist','password')).addClass('invalid');
                    }else{
                        _this.createSuperUser(_this);
                    }
                }
                
                if(action === 'edit'){
                    if(user){
                        _this.email.after(_this.errorDOM('Email already exist','password')).addClass('invalid');
                    }else{
                        _this.updateSuperUser(_this);
                    }
                }
            }
        });
    }

    /**
     * Create a new admin
     * @param _this
     */
    createSuperUser(_this){
        $.ajax({
            type : 'POST',
            url : '/dashboard/manage/super-users/create',
            data : {
                email : _this.getEmail(),
                password : _this.getPassword(),
                _token : $("meta[name=_token]").attr('content')
            },
            success : function(res){
                if(res){

                    window.location = '/dashboard/manage/super-users/users-list';
                }
            }
        });
    }

    updateSuperUser(_this){
        $.ajax({
            type : 'POST',
            url : '/dashboard/manage/super-users/update',
            data : {
                email : _this.getEmail(),
                old_email : _this.getOldEmail(),
                password : _this.getPassword(),
                _token : $("meta[name=_token]").attr('content')
            },
            success : function(res){
                if(res){
                    window.location = '/dashboard/manage/super-users/users-list';
                }
            }
        });
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
     * Get Confirm password
     * @returns {*}
     */
    getConfirmPassword(){
        return $.trim(this.confirm_password.val());
    }

    /**
     * Get cold email
     * @returns {*}
     */
    getOldEmail(){
        return $.trim(this.email.attr('data-old-email'));
    }

    /**
     * Validate form
     * @returns {*}
     */
    allValid(){
        return (this.getEmail().length &&
                this.getPassword().length &&
                this.getConfirmPassword().length);
    }

    /**
     * Generates Error DOM
     * @param message
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

new ssuUser();