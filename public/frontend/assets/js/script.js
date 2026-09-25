

(function() {
    const selectedDivision = "{{ old('division', auth()->user()->division ?? '') }}";
    const selectedDistrict = "{{ old('district', auth()->user()->district ?? '') }}";
    const selectedUpazila = "{{ old('upazila', auth()->user()->upazila ?? '') }}";
    const selectedUnion = "{{ old('union', auth()->user()->union ?? '') }}";

    document.addEventListener('DOMContentLoaded', function () {
        const divisionSelect = document.getElementById('division');
        const districtSelect = document.getElementById('district');
        const upazilaSelect = document.getElementById('upazila');
        const unionSelect = document.getElementById('union');

        const dnccThanas = ['Uttara', 'Banani', 'Gulshan', 'Mohakhali', 'Rampura', 'Tejgaon', 'Mirpur'];
        const dsccThanas = ['Dhanmondi', 'Wari', 'Paltan', 'Motijheel', 'Lalbagh', 'Ramna', 'Kotwali', 'Sutrapur', 'Chawkbazar', 'Gendaria', 'Jatrabari'];

        // Load divisions
        fetch('https://bdapi.vercel.app/api/v.1/division')
            .then(res => res.json())
            .then(data => {
                data.data.forEach(division => {
                    const option = new Option(division.name, division.name);
                    if (division.name === selectedDivision) option.selected = true;
                    divisionSelect.add(option);
                });

                // trigger change if division was pre-selected
                if (selectedDivision) divisionSelect.dispatchEvent(new Event('change'));
            });

        divisionSelect.addEventListener('change', function () {
            const selectedDivisionName = this.value;

            districtSelect.length = 1;
            upazilaSelect.length = 1;
            unionSelect.length = 1;

            fetch('https://bdapi.vercel.app/api/v.1/division')
                .then(res => res.json())
                .then(data => {
                    const division = data.data.find(d => d.name === selectedDivisionName);
                    if (!division) return;

                    fetch(`https://bdapi.vercel.app/api/v.1/district/${division.id}`)
                        .then(res => res.json())
                        .then(data => {
                            data.data.forEach(district => {
                                const option = new Option(district.name, district.name);
                                if (district.name === selectedDistrict) option.selected = true;
                                districtSelect.add(option);
                            });

                            // trigger change if district was pre-selected
                            if (selectedDistrict) districtSelect.dispatchEvent(new Event('change'));
                        });
                });
        });

        districtSelect.addEventListener('change', function () {
            const selectedDistrictName = this.value;

            upazilaSelect.length = 1;
            unionSelect.length = 1;

            if (selectedDistrictName === 'Dhaka') {
                upazilaSelect.add(new Option('Dhaka North City Corporation', 'Dhaka North City Corporation'));
                upazilaSelect.add(new Option('Dhaka South City Corporation', 'Dhaka South City Corporation'));

                // Set selected upazila
                if (selectedUpazila === 'Dhaka North City Corporation' || selectedUpazila === 'Dhaka South City Corporation') {
                    upazilaSelect.value = selectedUpazila;
                    upazilaSelect.dispatchEvent(new Event('change'));
                }
            }

            fetch('https://bdapi.vercel.app/api/v.1/district')
                .then(res => res.json())
                .then(data => {
                    const district = data.data.find(d => d.name === selectedDistrictName);
                    if (!district) return;

                    fetch(`https://bdapi.vercel.app/api/v.1/upazilla/${district.id}`)
                        .then(res => res.json())
                        .then(data => {
                            data.data.forEach(upazila => {
                                if (upazila.name !== 'Dhaka North City Corporation' && upazila.name !== 'Dhaka South City Corporation') {
                                    const option = new Option(upazila.name, upazila.name);
                                    if (upazila.name === selectedUpazila) option.selected = true;
                                    upazilaSelect.add(option);
                                }
                            });

                            if (selectedUpazila && selectedDistrictName !== 'Dhaka') {
                                upazilaSelect.dispatchEvent(new Event('change'));
                            }
                        });
                });
        });

        upazilaSelect.addEventListener('change', function () {
            const selectedUpazilaName = this.value;

            unionSelect.length = 1;

            if (selectedUpazilaName === 'Dhaka North City Corporation') {
                dnccThanas.forEach(thana => {
                    const option = new Option(thana, thana);
                    if (thana === selectedUnion) option.selected = true;
                    unionSelect.add(option);
                });
                return;
            }

            if (selectedUpazilaName === 'Dhaka South City Corporation') {
                dsccThanas.forEach(thana => {
                    const option = new Option(thana, thana);
                    if (thana === selectedUnion) option.selected = true;
                    unionSelect.add(option);
                });
                return;
            }

            fetch('https://bdapi.vercel.app/api/v.1/upazilla')
                .then(res => res.json())
                .then(data => {
                    const upazila = data.data.find(u => u.name === selectedUpazilaName);
                    if (!upazila) return;

                    fetch(`https://bdapi.vercel.app/api/v.1/union/${upazila.id}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.data && data.data.length > 0) {
                                data.data.forEach(union => {
                                    const option = new Option(union.name, union.name);
                                    if (union.name === selectedUnion) option.selected = true;
                                    unionSelect.add(option);
                                });
                            }
                        });
                });
        });
    });
})();

