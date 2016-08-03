function format() {
    var args = arguments;

    return args[0].replace(/{(\d+)}/g, function(match, number) { 
     	return typeof args[number] != 'undefined' ? args[number] : match;
    });
 }

window.core = $.extend({}, {
	title: function(text) {
		document.title = text + " - Actividad reciente";
	},
	hash: function(r) {
		var hashParams = {};
		var e,
			a = /\+/g,  // Regex for replacing addition symbol with a space
			d = function (s) {
				return decodeURIComponent(s.replace(a, " "));
			},
			q = window.location.hash.substring(1);
			r = /([^&;=]+)=?([^&;]*)/g;
			r = /\/(.*)\/(.*)$/g;
			// r = r || /([^&;=]+)=?([^&;]*)/g;
			// r = /([^&;=]+)=?([^&;]*)/g;
		
		while (e = r.exec(q)) {
			hashParams[e[1]] = d(e[2]);
		}

		return hashParams;
	},
	start_watcher: function(handler, interval) {
		var _scope = this,
			interval = interval || 3000;
			previous = window.location.hash;

		if(handler)
			_scope.hashChangeHandler = handler;

		setInterval(function() {
			if(previous !== window.location.hash) {
				previous = window.location.hash;
				_scope.hashChangeHandler(core.hash());
			}

		}, interval);

		_scope.hashChangeHandler(core.hash());
	},
	hashChangeHandler: function(hash) {
		// TODO: implementar
	},
	getType: function(val) {
		return Object.prototype.toString.call(val).replace(/^\[object (.+)\]$/,"$1").toLowerCase();
	},
	toDate: function(value) {
		switch(core.getType(value)) {
			case 'string':
				var _date = new Date();
				if(value && value.length > 0) {
					var t = (new RegExp(/^(\d{4})\-(\d{2})\-(\d{2})\ (\d{2})\:(\d{2})\:(\d{2})\.(\d{0,6})/)).exec(value);

					_date.setFullYear(t[1]);
					_date.setMonth(t[2] - 1);
					_date.setDate(t[3]);
					_date.setHours(t[4]);
					_date.setMinutes(t[5]);
					_date.setSeconds(t[6]);

					return _date;
				}
				break;
		}
	},
	toString: function(value) {
		switch(core.getType(value)) {
			case 'date':
				utils.dateFormat(value);
				break;
		}
	},
	format: function() {
		var s = arguments[0];
		for (var i = 0; i < arguments.length - 1; i++) {
			var reg = new RegExp("\\{" + i + "\\}", "gm");
			s = s.replace(reg, arguments[i + 1]);
		}
		return s;
	},
	codeParser: {
		codes: {
			PIN: 0,
			RIF: 1,
			EAN13: 2
		},
		codes_exp: {
			pin: new RegExp(/^([v|e|p])?[\-]?(\d{8,9})$/i),
			rif: new RegExp(/^([v|e|p|j|g])?[\-]?(\d{8,9})[\-](\d)$/i),
			ean13: new RegExp(/^(\d{12,13})[\-]?(\d)?$/i)
		},
		detectCode: function(code) {
			if(this.codes_exp.pin.exec(code) !== null) return this.codes.PIN;
			if(this.codes_exp.rif.exec(code) !== null) return this.codes.RIF;
			if(this.codes_exp.ean13.exec(code) !== null) return this.codes.EAN13;

			return 'undefined';
		}
	},
	provider: {
		url_api: 'http://api.iutcumana.edu.ve',
		mime: function(headers) {
			var type = 'undefined';
			try {
				type = headers.match(/Content\-Type\:\ (.*);/)[1] || "undefined";
			} catch(e) {}
			return type;
		},
		fetch: function(point, params, handler, method, timeo) {
			return $.ajax({
				url: core.provider.url_api + point,
				context: document.body,
				type: method || 'POST',
				data: params,
				timeout: timeo || 10000,
				error: function(response, t) { 
					// TODO: implementar 3 parametros: error, description, code
					var data = {};

					if(response.contentType == 'application/json') {
						// console.log(response.responseText);
						data = $.parseJSON(response.responseText);
					}

					if(handler.timeout && t === 'timeout') {
						console.log(t);
						// console.log(handler.timeout);
						// handler.timeout.apply(response);
					} else 
						if(handler.error) 
							handler.error(
								data[0].errors.message,  // error
								data[0].errors.description,  // description
								response);
				},
				success: function(plain, status, response) {
					var data = {};

					if(response.contentType == 'application/json') {
						// console.log(response.responseText);
						data = $.parseJSON(response.responseText);
					}

					if(handler.success) handler.success(data, response);
				},
				complete: function(response, status) {
					var data = {};

					if(response.contentType == 'application/json') {
						data = $.parseJSON(response.responseText);
					}

					if(handler.complete) 
						handler.complete(data);
				},
				loading: handler.loading || function() {}
			});
		}
	}
});

window.services = $.extend({}, {
	notifyUser: {
		notify: function(message) {
			$('#sucessbox_description')
				.empty()
				.append(message);
			$("[name='success']")
				.fadeIn(300)
				.delay(3000)
				.fadeOut(500);
		}
	},
	notifyError: {
		notify: function(message) {
			$('#errorbox_description')
				.empty()
				.append(message);
			$("[name='error']")
				.fadeIn(300)
				.delay(3000)
				.fadeOut(500);
		}
	}
})

window.utils = $.extend({}, {
	dateFormat: function() {
		var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
			timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
			timezoneClip = /[^-+\dA-Z]/g,
			pad = function (val, len) {
				val = String(val);
				len = len || 2;
				while (val.length < len) val = "0" + val;
				return val;
			};

		// Some common format strings
		var masks = {
			"default":      "ddd mmm dd yyyy HH:MM:ss",
			shortDate:      "m/d/yy",
			mediumDate:     "mmm d, yyyy",
			longDate:       "mmmm d, yyyy",
			fullDate:       "dddd, mmmm d, yyyy",
			shortTime:      "h:MM TT",
			mediumTime:     "h:MM:ss TT",
			longTime:       "h:MM:ss TT Z",
			isoDate:        "yyyy-mm-dd",
			isoTime:        "HH:MM:ss",
			isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
			isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
		};

		// Internationalization strings
		var i18n = {
			dayNames: [
				"dom", "lun", "mar", "mie", "jue", "vie", "sab",
				"domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"
			],
			monthNames: [
				"ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic",
				"enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "Agosto", "septiembre", "octubre", "noviembre", "diciembre"
			]
		};

		// Regexes and supporting functions are cached through closure
		return function (date, mask, utc) {
			// var dF = dateFormat;

			// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
			if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
				mask = date;
				date = undefined;
			}

			// Passing date through Date applies Date.parse, if necessary
			date = date ? new Date(date) : new Date;
			if (isNaN(date)) throw SyntaxError("invalid date");

			mask = String(masks[mask] || mask || masks["default"]);

			// Allow setting the utc argument via the mask
			if (mask.slice(0, 4) == "UTC:") {
				mask = mask.slice(4);
				utc = true;
			}

			var	_ = utc ? "getUTC" : "get",
				d = date[_ + "Date"](),
				D = date[_ + "Day"](),
				m = date[_ + "Month"](),
				y = date[_ + "FullYear"](),
				H = date[_ + "Hours"](),
				M = date[_ + "Minutes"](),
				s = date[_ + "Seconds"](),
				L = date[_ + "Milliseconds"](),
				o = utc ? 0 : date.getTimezoneOffset(),
				flags = {
					d:    d,
					dd:   pad(d),
					ddd:  i18n.dayNames[D],
					dddd: i18n.dayNames[D + 7],
					m:    m + 1,
					mm:   pad(m + 1),
					mmm:  i18n.monthNames[m],
					mmmm: i18n.monthNames[m + 12],
					yy:   String(y).slice(2),
					yyyy: y,
					h:    H % 12 || 12,
					hh:   pad(H % 12 || 12),
					H:    H,
					HH:   pad(H),
					M:    M,
					MM:   pad(M),
					s:    s,
					ss:   pad(s),
					l:    pad(L, 3),
					L:    pad(L > 99 ? Math.round(L / 10) : L),
					t:    H < 12 ? "a"  : "p",
					tt:   H < 12 ? "am" : "pm",
					T:    H < 12 ? "A"  : "P",
					TT:   H < 12 ? "AM" : "PM",
					Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
					o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
					S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
				};

			return mask.replace(token, function ($0) {
				return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
			});
		};
	}(),
	dateToShort: function(date) {
		if(core.getType(date) != 'date') return "";

		if(date.getFullYear() == (new Date()).getFullYear()) {
			if(date.getMonth() == (new Date()).getMonth()) {
				if(date.getDate() == (new Date()).getDate()) {
					return this.dateFormat(date, "h:MM tt");
				}
				return this.dateFormat(date, "ddd dd");
			}
			return this.dateFormat(date, "dd mmm");
		}
		return this.dateFormat(date, "dd mmm yyyy");
	},
	dateLast: function(date) {
		if(core.getType(date) != 'date') return "";

		if(date.getFullYear() == (new Date()).getFullYear()) {
			if(date.getMonth() == (new Date()).getMonth()) {
				if(date.getDate() == (new Date()).getDate()) {
					return this.dateFormat(date, "h:MM tt");
				}
				return this.dateFormat(date, "ddd dd");
			}
			return this.dateFormat(date, "dd mmm");
		}
		return this.dateFormat(date, "dd mmm yyyy");
	},
	urlbuilder: function(domain) {
		var builder = new (function(domain) {
			var _protocol = 'http',
				_domain = '',
				_port = 80,
				_paths = [],
				_params = [],
				_hash = "";

			this.parseURL = function(url) {
				// SCHEMA = 2
				// DOMAIN = 3
				// PORT = 5
				// PATH = 6
				// FILE = 8
				// QUERYSTRING = 9
				// HASH = 12
				var parts = url.match(/^((http[s]?|ftp):\/)?\/?([^:\/\s]+)(:([^\/]*))?((\/[\w/-]+)*\/)([\w\-\.]+[^#?\s]+)(\?([^#]*))?(#(.*))?$/);

				return parts;
			}
			this.domain = function(domain) {
				_domain = domain;

				return this;
			}
			this.port = function(port) {
				this._port = (port!==80)?port:'';
			}
			this.addpath = function(path) {
				_paths.push(path);

				return this;
			}
			this.addparam = function(param, value) {
				_params.push({
					'name': param,
					'value': value
				});

				return this;
			}
			this.addhash = function(hash) {
				_hash = hash;
			}
			this.tostring = function() {
				var params = [];

				for(iterator in _params) 
					params.push(_params[iterator].name + '=' + encodeURIComponent(_params[iterator].value));

				var params_query = (params.length !== 0)?'?' + params.join('&'):'';

				return (_protocol + '://' + domain + '/' + _paths.join('/') + params_query).toLowerCase();
			}
			this.doparse = function(url) {
				var parts = this.parseURL(url);
				console.log(parts);
				_domain	= parts[3];
				_port	= parts[5];
				//_paths	= (parts[6])?parts[6].split('/'):[];
				_hash	= parts[12];
				// _params = parts[9].split('&');
			}

			this.doparse(domain);

			return this;
		})(domain);

		return builder;
	},
	rawURIencode: function(str) {
		str = (str+'').toString();
		return str
			.replace(/ $/g,'')
			.replace(/^ /g,'')
			.replace(/ /g,'+');
	},
	// forceNumeric() plug-in implementation
	forceNumeric: function () {
		return this.each(function () {
			$(this).keydown(function (e) {
				var key = e.which || e.keyCode;
				
				if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
					// numbers
					key >= 48 && key <= 57 ||
					// Numeric keypad
					key >= 96 && key <= 105 ||
					// comma, period and minus, . on keypad
					key == 190 || key == 188 || key == 109 || key == 110 ||
					// Backspace and Tab and Enter
					key == 8 || key == 9 || key == 13 ||
					// Home and End
					key == 35 || key == 36 ||
					// left and right arrows
					key == 37 || key == 39 ||
					// Del and Ins
					key == 46 || key == 45)
					return true;

				return false;
			});
		});
	}
});

jQuery.fn.forceNumeric = utils.forceNumeric;