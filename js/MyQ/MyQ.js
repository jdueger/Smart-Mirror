var MyQ = {
	MyQLocation: '.MyQ',
	params: keys.MyQ.params || null,
	updateInterval: 300000,
	fadeInterval: 1000,
	intervalId: null
};

/**
 * Retrieves the garage door states from the Chamberlain MyQ API
 */
MyQ.updateCurrentState = function () {

	$.ajax({
		type: 'GET',
		url: 'controllers/MyQ/MyQ_Login.php?',
		dataType: 'json',
		data: MyQ.params,
		success: function (data) {
			var _securityToken = data.SecurityToken;

			var detailsParams = {securityToken:_securityToken,appId:MyQ.params.appId};

			$.ajax({
				type: 'GET',
				url: 'controllers/MyQ/MyQ_Details.php?',
				dataType: 'json',
				data: detailsParams,
				success: function (data) {
					
					var table = $('<table/>').addClass('xsmall').addClass('calendar-table');
					var opacity = 0.75;
					var row = $('<tr/>').css('opacity', opacity);
										
					row.append($('<td/>').addClass('fa-down').addClass(MyQ.getSymbol(data.Devices[3].Attributes[3].Value)).addClass('myq-icon'));
					row.append($('<td/>').html(data.Devices[3].Attributes[2].Value).addClass('description'));
					row.append($('<td/>').html(MyQ.getPhrase(data.Devices[3].Attributes[3].Value)).addClass('description'));
					table.append(row);
					row = $('<tr/>').css('opacity',opacity);
					row.append($('<td/>').addClass('fa-down').addClass(MyQ.getSymbol(data.Devices[2].Attributes[3].Value)).addClass('myq-icon'));
					row.append($('<td/>').html(data.Devices[2].Attributes[2].Value).addClass('description'));
					row.append($('<td/>').html(MyQ.getPhrase(data.Devices[2].Attributes[3].Value)).addClass('description'));
					table.append(row);
					
					$(this.MyQLocation).updateWithText(table, this.fadeInterval);
					
				}.bind(this),
				error: function () {
				}
			});

		}.bind(this),
		error: function () {
		}
	});	
	
};

MyQ.getPhrase = function(_doorState){

	var _doorPhrase = 'is Closed';

	//Verbal door position
	if(_doorState == 1){
		_doorPhrase = 'is Open';
	} else if (_doorState == 4){
		_doorPhrase = 'is Opening';
	} else if (_doorState == 5){
		_doorPhrase = 'is Closing';
	} else {
		_doorPhrase = 'is Closed';
	}

	return _doorPhrase;
};

MyQ.getSymbol = function(_doorState){

	var _doorSymbol = 'fa-lock';

	//Verbal door position
	if(_doorState == 1){
		_doorSymbol = 'fa-unlock';
	} else if (_doorState == 2){
		_doorSymbol = 'fa-lock';
	} else {
		_doorSymbol = 'fa-lock-alt';
	}

	return _doorSymbol;
};

MyQ.init = function () {

	this.updateCurrentState();

	this.intervalId = setInterval(function () {
		this.updateCurrentState();
	}.bind(this), this.updateInterval);

};
