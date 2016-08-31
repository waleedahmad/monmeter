class Client{

    /**
     * User Access control edit
     */
    accessControlInit(){
        $(".access-enable").on('click', function (e) {
            $(".access").removeClass('ticked');
            $(this).addClass("ticked");
            $("#user-access").val('enabled');
            $(".message.disabled-message").slideUp();
        });

        $(".access-disable").on('click', function (e) {
            $(".access").removeClass('ticked');
            $(this).addClass("ticked");
            $("#user-access").val('disabled');
            $(".message.disabled-message").slideDown();
        });
    }

    /**
     * Update user access
     */
    updateAccessInit(){
        var _this = this;
        $(".accessUpdateBtn").on('click', function(){
            var client_id = $("#client-id").val(),
                access = $("#user-access").val(),
                token = $("meta[name=_token]").attr('content');

            $.ajax({
                url : '/dashboard/user-control/update/access',
                type : 'POST',

                data : {
                    client : client_id,
                    access : access,
                    _token : token
                },
                success : function(res){
                    if(res.updated){
                        console.log(res);
                        _this.requestClientAPI(res.details, res.ip,'updateuser', '/dashboard/user-control/user-list');
                    }
                }
            });

            console.log(client_id, access);
        });
    }

    /**
     * Get Name
     * @returns {*}
     */
    getName(){
        return $.trim(this.name.val());
    }

    /**
     * Get Company
     * @returns {*}
     */
    getCompany(){
        return $.trim(this.company.val());
    }

    /**
     * Get Card Identifier
     * @returns {*}
     */
    getCardIdentifier(){
        return $.trim(this.card_identifier.val());
    }

    /**
     * get old card identifier
     * @returns {*}
     */
    getOldCardIdentifier(){
        return $.trim(this.card_identifier.attr('data-old-tag'));
    }

    /**
     * Get enotes
     * @returns {*}
     */
    getENotes(){
        return $.trim(this.enotes.val());
    }

    /**
     * Get Date
     * @returns {*}
     */
    getDate(){
        return $.trim(this.date.val());
    }

    /**
     * Get User Access
     * @returns {*}
     */
    getUserAccess(){
        return $.trim(this.user_access.val());
    }

    /**
     * Get client id
     * @returns {*}
     */
    getClientId(){
        return $.trim(this.client_id.val());
    }

    /**
     * Validate form
     * @returns {*}
     */
    allValid(){
        return (this.getName().length &&
                this.getCompany().length &&
                this.getCardIdentifier().length &&
                this.getDate() &&
                this.getUserAccess()
        );
    }

    /**
     * Create new client
     * @param _this
     */
    createClient(_this){
        $.ajax({
            type : 'POST',
            url : '/dashboard/user-control/create',
            data : {
                name : _this.getName(),
                company : _this.getCompany(),
                date : _this.getDate(),
                card_identifier : _this.getCardIdentifier(),
                enote : _this.getENotes(),
                access : _this.getUserAccess(),
                _token : $("meta[name=_token]").attr('content')
            },
            success : function(res){
                if(res.status){
                    console.log(res);
                    _this.requestClientAPI(res.details, res.ip,'adduser', '/dashboard/user-control/user-list');
                }
            }
        });
    }

    /**
     * Make arduino api call to add/update user
     * @param user
     * @param ip
     * @param action
     */
    requestClientAPI(user, ip, action, reload){
        var status = (user.access) ? 1 : 0;
        var seekLoc = user.id - 1;
        $.ajax({
            type : 'POST',
            url : 'http://'+ip+'/'+action+'/?card_tag='+user.card_tag+'&status='+status+'&seekLoc='+seekLoc+'!',
            success : function(res){
                console.log(res);
                window.location = reload;
            }

        });
    }

    /**
     * Update client
     * @param _this
     */
    updateClient(_this){
        $.ajax({
            type : 'POST',
            url : '/dashboard/user-control/update',
            data : {
                name : _this.getName(),
                company : _this.getCompany(),
                date : _this.getDate(),
                card_identifier : _this.getCardIdentifier(),
                enote : _this.getENotes(),
                access : _this.getUserAccess(),
                _token : $("meta[name=_token]").attr('content'),
                client_id : _this.getClientId()
            },
            success : function(res){
                if(res){
                    window.location = '/dashboard/user-control/user-list';
                }
            }
        });
    }

    /**
     * Validate Tag
     * @param tag
     * @param _this
     * @param action
     */
    validateTag(tag,_this, action){
        $.ajax({
            type : 'GET',
            url : '/dashboard/user-control/exist',
            data : {
                tag : tag
            },
            success : function(tag){
                if(action === 'new'){
                    if(tag){
                        _this.card_identifier.after(_this.errorDOM('Tag already exist','password')).addClass('invalid');
                    }else{
                        _this.createClient(_this);
                    }
                }

                if(action == 'update'){
                    if(tag){
                        _this.card_identifier.after(_this.errorDOM('Tag already exist', 'password')).addClass('invalid');
                    }else{
                        _this.updateClient(_this);
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
        e.preventDefault();
        var _this = e.data.context;
        $(".invalid-input-tooltip").remove();

        if(_this.allValid()){
            _this.validateTag(_this.getCardIdentifier(),_this, 'new');
        }else{

            if(!_this.getName().length){
                _this.name.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getCompany().length){
                _this.company.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getCardIdentifier().length){
                _this.card_identifier.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getDate().length){
                _this.date.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

        }
    }

    /**
     * Validate form fields
     * @param e
     */
    validateEditForm(e){
        console.log("Edit validate form");
        e.preventDefault();
        var _this = e.data.context;
        $(".invalid-input-tooltip").remove();

        if(_this.allValid()){
            if(_this.getCardIdentifier() != _this.getOldCardIdentifier()){
                _this.validateTag(_this.getCardIdentifier(),_this , 'update');
            }else {
                _this.updateClient(_this);
            }
        }else{
            if(!_this.getName().length){
                _this.name.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getCompany().length){
                _this.company.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getCardIdentifier().length){
                _this.card_identifier.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

            if(!_this.getDate().length){
                _this.date.after(_this.errorDOM('Missing data','invalid')).addClass('invalid');
            }

        }
    }
    
    
    constructor(){
        this.name = $("#name");
        this.company = $("#company");
        this.date = $("#uc-date");
        this.card_identifier = $("#card-identifier");
        this.enotes = $("#enotes");
        this.user_access = $("#user-access");
        this.client_id = $("#client-id")

        this.updateAccessInit();
        this.accessControlInit();
        $("#uc-date").datepicker({ dateFormat: 'dd-mm-yy' });

        $(".user-control .add-user-form form").on('submit', {context : this}, this.validateForm);
        $(".user-control .edit-user-form form").on('submit', {context : this}, this.validateEditForm);
        $("#name, #company, #uc-date, #card-identifier").on('keyup change', function(){
            $(this).siblings(".invalid-input-tooltip").remove();
            $(this).removeClass('invalid');
        });
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

new Client();