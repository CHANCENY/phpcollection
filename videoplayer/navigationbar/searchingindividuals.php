<section><div class="about-us"><h1 class="about-us-about-us">Find Service providers</h1></div></section>

<section class="service-provider-search-enigne">
	<div class="closed-inputs">
		<form action="Search.php" method="get">
				<select class="input" name="selectvalue" required>
					<option value="">Select categories</option>
				    <option>VIP</option>
				     <option>PREMIUM</option>
				      <option>STANDARD</option>
				       <option>BASIC</option>
				       <option>BUDGET</option>
			    </select>
			    <input type="hidden" name="check" value="1">
				<input type="text" name="searching" placeholder="Title" class="input" required>
				<input type="text" name="charges" placeholder="Charges" class="input" required>
				<input type="text" name="status" placeholder="Status" class="input" required>
				<input type="submit" name="searchsubmit" value="Search providers" class="sendingbutton" style="margin-left: 40%;">
		</form>
	</div>
</section>