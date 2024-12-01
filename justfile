run file="example.txt" day=datetime('%e'):
    cd "day{{ trim(day) }}"; go run . '{{ file }}'

