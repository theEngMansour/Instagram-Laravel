

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

  <!-- Import typeahead.js -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> -->

	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->

    <!-- Import typeahead.js -->
	<script src="{{ asset('assets/js/typeahead.bundle.js') }}"></script>


<script type="text/javascript">
	$(document).ready(function() {
    		var bloodhound = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.whitespace,
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: {
					url: '{{url("search")}}?searchname=%QUERY%',//'/user/find?q=%QUERY%',
					wildcard: '%QUERY%'
				},
			});
			
			$('#search').typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				name: 'users',
				source: bloodhound,
				limit:10,
				display: function(data) {
					return data.name  //Input value to be set when you select a suggestion. 
				},
				/* عرض الاقترحات بعد البداْ بالكتابة */
				templates: {
					/* عندما لايجد قيمة مطابقة  */
					empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item" style="direction: rtl; text-align: right; ">لا يوجد نتائج بحث مطابقة</div></div>'
					],
					header: [
						'<div class="list-group search-results-dropdown">'
					],
					/* في حالة وجد  */
					suggestion: function(data) {
					return '<div style="font-weight:normal;direction: rtl; text-align: right; width:100%" class="list-group-item"> <a href="{{url('user_info')}}/'+data.id+'"> <img src="{{asset('images/avatar')}}/'+data.avatar+'" style=" margin-left: 2%; " width="35px" height="35px"/>' + data.first_name+' '+data.last_name + '</a></div></div>'
					}
				}
			});
        });
</script>
</body>