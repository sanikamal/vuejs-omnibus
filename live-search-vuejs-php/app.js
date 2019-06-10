var app = new Vue({
	el: '#myapp',
	data:{
		employees: [],
		search: {keyword: ''},
		noEmployee: false
	},

	mounted: function(){
		this.fetchEmployees();
	},

	methods:{
		searchMonitor: function() {
			var keyword = app.toFormData(app.search);
	   		axios.post('action.php?action=search', keyword)
				.then(function(response){
					app.employees = response.data.employees;

					if(response.data.employees == ''){
						app.noEmployee = true;
					}
					else{
						app.noEmployee = false;
					}
				});
       	},

       	fetchEmployees: function(){
			axios.post('action.php')
				.then(function(response){
					app.employees = response.data.employees;
				});
       	},

		toFormData: function(obj){
			var form_data = new FormData();
			for(var key in obj){
				form_data.append(key, obj[key]);
			}
			return form_data;
		},

	}
});
