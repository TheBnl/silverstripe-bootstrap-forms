<div $AttributesHTML>
    <% if $Options.Count %>
        <% loop $Options %>
            <div class="form-check $Class" role="$Role">
                <input id="$ID" class="form-check-input checkbox" name="$Name" type="checkbox" value="$Value.ATT"<% if $isChecked %> checked="checked"<% end_if %><% if $isDisabled %> disabled="disabled"<% end_if %> />
                <label class="form-check-label" for="$ID">$Title</label>
            </div>
        <% end_loop %>
    <% else %>
        <div><%t SilverStripe\\Forms\\CheckboxSetField_ss.NOOPTIONSAVAILABLE 'No options available' %></div>
    <% end_if %>
</div>
