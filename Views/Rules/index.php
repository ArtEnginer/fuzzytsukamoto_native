<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuzzy Logic Input Form</title>
    <style>
        .form-section {
            margin-bottom: 20px;
        }

        .form-section label {
            display: block;
            margin-bottom: 5px;
        }

        .form-section input {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h1>Fuzzy Logic Input Form</h1>
    <form id="fuzzyForm" action="process_fuzzy_logic.php" method="post">
        <div class="form-section">
            <h2>Kriteria 1</h2>
            <label>
                <input type="checkbox" name="subcriteria[]" value="1"> Sub-kriteria 1.1
                <select name="subcriteria_type[]">
                    <option value="include">Include</option>
                    <option value="exclude">Not</option>
                </select>
            </label>
            <label>
                <input type="checkbox" name="subcriteria[]" value="2"> Sub-kriteria 1.2
                <select name="subcriteria_type[]">
                    <option value="include">Include</option>
                    <option value="exclude">Not</option>
                </select>
            </label>
            <label>
                <input type="checkbox" name="subcriteria[]" value="3"> Sub-kriteria 1.3
                <select name="subcriteria_type[]">
                    <option value="include">Include</option>
                    <option value="exclude">Not</option>
                </select>
            </label>
        </div>

        <div class="form-section">
            <h2>Kriteria 2</h2>
            <label>
                <input type="checkbox" name="subcriteria[]" value="4"> Sub-kriteria 2.1
                <select name="subcriteria_type[]">
                    <option value="include">Include</option>
                    <option value="exclude">Not</option>
                </select>
            </label>
            <label>
                <input type="checkbox" name="subcriteria[]" value="5"> Sub-kriteria 2.2
                <select name="subcriteria_type[]">
                    <option value="include">Include</option>
                    <option value="exclude">Not</option>
                </select>
            </label>
            <label>
                <input type="checkbox" name="subcriteria[]" value="6"> Sub-kriteria 2.3
                <select name="subcriteria_type[]">
                    <option value="include">Include</option>
                    <option value="exclude">Not</option>
                </select>
            </label>
        </div>

        <div class="form-section">
            <h2>Kriteria 3</h2>
            <label>
                <input type="checkbox" name="subcriteria[]" value="7"> Sub-kriteria 3.1
                <select name="subcriteria_type[]">
                    <option value="include">Include</option>
                    <option value="exclude">Not</option>
                </select>
            </label>
            <label>
                <input type="checkbox" name="subcriteria[]" value="8"> Sub-kriteria 3.2
                <select name="subcriteria_type[]">
                    <option value="include">Include</option>
                    <option value="exclude">Not</option>
                </select>
            </label>
            <label>
                <input type="checkbox" name="subcriteria[]" value="9"> Sub-kriteria 3.3
                <select name="subcriteria_type[]">
                    <option value="include">Include</option>
                    <option value="exclude">Not</option>
                </select>
            </label>
        </div>

        <label for="condition">Condition:</label>
        <select id="condition" name="condition">
            <option value="AND">AND</option>
            <option value="OR">OR</option>
        </select>

        <input type="submit" value="Submit">
    </form>

    <script>
        document.getElementById('fuzzyForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = event.target;
            const condition = form.condition.value;
            const subcriteria = [];
            const notCriteria = [];

            form.querySelectorAll('input[name="subcriteria[]"]:checked').forEach((input, index) => {
                const type = form.querySelectorAll('select[name="subcriteria_type[]"]')[index].value;
                if (type === 'include') {
                    subcriteria.push(parseInt(input.value));
                } else {
                    notCriteria.push(parseInt(input.value));
                }
            });

            const result = {
                condition: condition,
                subcriteria: subcriteria,
                not: notCriteria.length ? notCriteria : undefined
            };

            console.log(result);

            fetch(form.action, {
                    method: form.method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(result)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    alert('Form submitted successfully! Check the console for the output.');
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>