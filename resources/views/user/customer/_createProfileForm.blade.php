{{--
	This is the form Customer Users use
	for completing
	their profile

	Input fields inlcude:
		Address Line 1
		Address Line 2
		Province
		Zip Code
		Landline
		Mobile
		Farm Address Line 1
		Farm Address Line 2
		Farm Address Province
		Farm Address Zip Code
		Farm type
		Farm landline
		Farm mobile
 --}}
<div class="row">
	<div class="col s12">
		<ul class="tabs z-depth-1">
			<li id="personal-tab" class="tab col s6"><a class="active" href="#personal-information">Personal Information</a></li>
			<li id="farm-tab" class="tab col s6"><a href="#farm-information">Farm Information</a></li>
		</ul>
	</div>
	<div class="col s12">
		<div id="personal-information" class="card-panel">

			<div class="row">
			{{-- Address: Address Line 1 --}}
				<div class="input-field col s10 push-s1">
					{!! Form::text('address_addressLine1', null, ['autofocus' => 'autofocus', 'id' => 'address_addressLine1'])!!}
					{!! Form::label('address_addressLine1', 'Address Line 1* : Street, Road, Subdivision') !!}
				</div>
			</div>


			<div class="row">
			{{-- Address: Address Line 2 --}}
				<div class="input-field col s10 push-s1">
					{!! Form::text('address_addressLine2', null, ['id' => 'address_addressLine2'])!!}
					{!! Form::label('address_addressLine2', 'Address Line 2* : Barangay, Town, City') !!}
				</div>
			</div>


			<div class="row">
				{{-- Address: Province --}}
				<div class="input-field col s5 push-s1">
					{!! Form::select('address_province', $provinces, null); !!}
					<label> Province* </label>
				</div>

				{{-- Address: Zip Code --}}
				<div class="input-field col s5 push-s1">
					{!! Form::text('address_zipCode', null, ['id' => 'address_zipCode'])!!}
					{!! Form::label('address_zipCode', 'Postal/ZIP Code*') !!}
				</div>
			</div>

			<div class="row">
				{{-- Landline --}}
				<div class="input-field col s5 push-s1">
					{!! Form::text('landline', null, ['id' => 'landline'])!!}
					{!! Form::label('landline', 'Landline') !!}
				</div>

				{{-- Mobile --}}
				<div class="input-field col s5 push-s1">
					{!! Form::text('mobile', null, ['id' => 'mobile'])!!}
					{!! Form::label('mobile', 'Mobile*') !!}
				</div>
			</div>

			<div class="row">
			  <div class="col s10 offset-s1">
				  <div class="col right">
					  <a href="#" id="next" class="btn-floating btn-medium waves-effect waves-light teal darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Next">
						  <i class="material-icons">chevron_right</i>
					  </a>
				  </div>
			  </div>
			</div>
		</div>

		<div id="farm-information" class="card-panel">
			<div id="farm-address-body">
				<div class="row add-farm">
				<div class="col s10 offset-s1">
					<div id="farm-1" class="card-panel hoverable">
						<h5 class="center-align"> Farm 1 </h5>

            {{-- Checkbox if Farm Address is same as Office Address --}}
            <div class="row">
              <input
                type="checkbox"
                id="check-1"
                class="same-address-checker farm-1 filled-in">
              <label for="check-1" class="teal-text text-darken-4"><b>Address is same as Office Information</b></label>
            </div>
            <br>

						<div class="row">
							{{-- Farm Address: Name --}}
							<div class="input-field col s10 push-s1">
								{!! Form::text('farmAddress[1][name]', null, ['id' => 'farmAddress[1][name]'])!!}
								{!! Form::label('farmAddress[1][name]', 'Name*') !!}
							</div>
						</div>


						<div class="row">
							{{-- Farm Address: Address Line 1 --}}
							<div class="input-field col s10 push-s1">
								{!! Form::text('farmAddress[1][addressLine1]', null, ['id' => 'farmAddress[1][addressLine1]', 'class' => 'farm-1-addressLine1'])!!}
								{!! Form::label('farmAddress[1][addressLine1]', 'Address Line 1* : Street, Road, Subdivision') !!}
							</div>
						</div>

						<div class="row">
							{{-- Farm Address: Address Line 2 --}}
							<div class="input-field col s10 push-s1">
								{!! Form::text('farmAddress[1][addressLine2]', null, ['id' => 'farmAddress[1][addressLine2]', 'class' => 'farm-1-addressLine2'])!!}
								{!! Form::label('farmAddress[1][addressLine2]', 'Address Line 2* : Barangay, Town, City') !!}
							</div>
						</div>

						<div class="row">
							{{-- Farm Address: Province --}}
							<div class="input-field col s5 push-s1">
								{!! Form::select('farmAddress[1][province]', $provinces, null); !!}
								<label> Province* </label>
							</div>

							{{-- Farm Address: Zip Code --}}
							<div class="input-field col s5 push-s1">
								{!! Form::text('farmAddress[1][zipCode]', null, ['id' => 'farmAddress[1][zipCode]', 'class' => 'farm-1-zipCode'])!!}
								{!! Form::label('farmAddress[1][zipCode]', 'Postal/ZIP Code*') !!}
							</div>
						</div>

						<div class="row">
							{{-- Farm Type --}}
							<div class="input-field col s5 push-s1">
								{!! Form::text('farmAddress[1][farmType]', null, ['id' => 'farmAddress[1][farmType]'])!!}
								{!! Form::label('farmAddress[1][farmType]', 'Farm Type*') !!}
							</div>
						</div>

						<div class="row">
							{{-- Farm Landline --}}
							<div class="input-field col s5 push-s1">
								{!! Form::text('farmAddress[1][landline]', null, ['id' => 'farmAddress[1][landline]', 'class' => 'farm-1-landline'])!!}
								{!! Form::label('farmAddress[1][landline]', 'Farm Landline') !!}
							</div>

							{{-- Farm Mobile --}}
							<div class="input-field col s5 push-s1">
								{!! Form::text('farmAddress[1][mobile]', null, ['id' => 'farmAddress[1][mobile]', 'class' => 'farm-1-mobile'])!!}
								{!! Form::label('farmAddress[1][mobile]', 'Farm Mobile*') !!}
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>

			<div class="row">
				<div class="col s10 offset-s1">
					<div class="col left">
						<a href="#" id="previous" class="btn-floating btn-medium waves-effect waves-light teal darken-1 tooltipped" data-position="right" data-delay="50" data-tooltip="Previous">
							<i class="material-icons">chevron_left</i>
						</a>
					</div>
					<div class="col right">
						<a href="#" id="add-farm" class="btn-floating btn-medium waves-effect waves-light blue tooltipped" data-position="left" data-delay="50" data-tooltip="Add another Farm">
							<i class="material-icons">add</i>
						</a>
					</div>
				</div>
			</div>

			{{-- Submit Button --}}
			<div class="row">
			  <button type="submit" class="btn waves-effect waves-light col s3 push-s8"> Submit
				  <i class="material-icons right">send</i>
			  </button>
			</div>
		</div>
	</div>
</div>
