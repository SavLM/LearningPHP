# JSON refresher from w3 schools

import json

###################

json_obj = '{ "Name":"Sav", "Gender":"Female", "Pets":[{ "Animal":"Dog", "Name":"AJ" },{ "Animal":"Cat", "Name":"Banshee" },{ "Animal":"Cat", "Name":"Tommy" }] }'
#convert to python object
python_obj = json.loads(json_obj)
print("\nJSON data:")
print(python_obj)
print("\nName: ",python_obj["Name"])
print("Gender: ",python_obj["Gender"])
print("\nPets:")
for i in python_obj["Pets"]:
  print(i["Animal"],"named",i["Name"])

###################

print(type(python_obj))
# convert into JSON:
j_data = json.dumps(python_obj)

# result is a JSON string:
print(j_data)

###################

python_dict =  python_obj
python_list =  ["Red", "Green", "Black"]
python_str =  "Python Json"
python_int =  (1234)
python_float =  (21.34)
python_T =  (True)
python_F =  (False)
python_N =  (None)

json_dict = json.dumps(python_dict)
json_list = json.dumps(python_list)
json_str = json.dumps(python_str)
json_num1 = json.dumps(python_int)
json_num2 = json.dumps(python_float)
json_t = json.dumps(python_T)
json_f = json.dumps(python_F)
json_n = json.dumps(python_N)

print("json dict : ", json_dict)
print("jason list : ", json_list)
print("json string : ", json_str)
print("json number1 : ", json_num1)
print("json number2 : ", json_num2)
print("json true : ", json_t)
print("json false : ", json_f)
print("json null ; ", json_n)

###################

j_str = {'4': 5, '6': 7, '1': 3, '2': 4}
print("Original String:")
print(j_str)
print("\nJSON data:")

#convert to json
j_str_p = json.dumps(j_str, sort_keys=True, indent=4)
print(j_str_p)

#check in reverse
p_obj = json.loads(j_str_p)
print(p_obj['2'])

###################

people_data = 0
with open('people.json') as f:
    people_data= json.load(f)
    for people in people_data['people']:
        del people['initials']
sorted_data = sorted(people_data['people'], key = lambda i: i['name'])
with open('new_people.json', 'w') as f:
    json.dump(sorted_data, f, indent=2)
