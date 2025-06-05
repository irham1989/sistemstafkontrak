<?php

namespace App\Repositories;

use App\Models\Staff;
use App\Models\StaffAcademic;
use App\Models\StaffFamily;
use App\Models\User;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffRepository
{
    use CommonTrait;
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function setBasicStaffProfile(User $user, Request $request){
        $m = new Staff;
        $m->user_id = $user->id;
        $m->phone_no = $request->mobile_phone;
        $m->save();
    }

    public function getStaffProfile($user_id){
        return Staff::with('getUser', 'getBumiputera', 'getCountry', 'getState', 'getGender', 'getRace', 'getReligion', 'getSalutation', 'getStaffPosition')->where('user_id', $user_id)->first();
    }

    public function storeUpdateProfile(Request $request){
        $name = $request->name;
        $identification_no = $request->identification_no;
        $address = $request->address;
        $email = $request->email;
        $city = $request->city;
        $postal_code = $request->postal_code;
        $country = $request->country;
        $state = $request->state;
        $mobile_phone = $request->mobile_phone;
        $marital = $request->marital;
        $race = $request->race;
        $race_other = $request->race_other;
        $bumiputera = $request->bumiputera;
        $bumiputera_other = $request->bumiputera_other;
        $dob = $request->dob;
        $birth_country = $request->birth_country;
        $birth_certificate = $request->birth_certificate;
        $birth_state = $request->birth_state;
        $gender = $request->gender;
        $salutation = $request->salutation;
        $religion = $request->religion;
        $blood_type = $request->blood_type;

        $staff_id = $request->staff_id;

        DB::beginTransaction();
        try{
            $staff = Staff::find($staff_id);
            $staff->address = $address;
            $staff->blood_type = $blood_type;
            $staff->city = $city;
            $staff->postal_code = $postal_code;
            $staff->race_id = $race;
            $staff->other_race = $race_other;
            $staff->country_id = $country;
            $staff->state_id = $state;
            $staff->phone_no = $mobile_phone;
            $staff->marital_status_id = $marital;
            $staff->bumiputera_id = $bumiputera;
            $staff->bumiputera_other = $bumiputera_other;
            $staff->dob = $dob ? $this->reverseDate($dob) : null;
            $staff->birth_country_id = $birth_country;
            $staff->birth_state_id = $birth_state;
            $staff->birth_certificate_no = $birth_certificate;
            $staff->gender_id = $gender;
            $staff->salutation_id = $salutation;
            $staff->religion_id = $religion;

            $existUser = $this->userRepository->checkExist($email, $identification_no, $staff->user_id);
            if($existUser['status'] == 'exist'){
                return [
                    'status' => 'error',
                    'message' => 'Pengguna Sudah Wujud'
                ];
            }

            $staff->profile_complete = 1;
            $staff->save();
            $existUser['user']->ic_no = $identification_no;
            $existUser['user']->save();
            $this->userRepository->storeUser($existUser['user'], $name, $email, 'staff', true);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => $exception->getMessage(),
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Rekod Peribadi Dikemaskini',
            'url' => route('staff.profile', ['user_id' => $staff->user_id, 'page' => 'main'])
        ];
    }

    public function getAcademicList(Request $request){
        $staff_id = $request->staff_id;

        $model = DB::select('
            SELECT
            ac.id,
            ac.certificate_name,
            ac.institution_name,
            ac.institution_location,
            ac.major_specialization,
            ac.minor_specialization,
            ac.overall_grade,
            aq.name as qualification
            FROM staff_academics ac
            JOIN academic_qualifications aq ON aq.id = ac.academic_qualification_id
            AND ac.staff_id = ?
            LIMIT 100
        ',[
            $staff_id
        ]);

        return $model;
    }

    public function storeUpdateAcademic(Request $request){
        $qualification = $request->qualification;
        $cert_name = $request->cert_name;
        $institution_name = $request->institution_name;
        $institution_location = $request->institution_location;
        $major_specialization = $request->major_specialization;
        $minor_specialization = $request->minor_specialization;
        $profession_cert_date = $request->profession_cert_date;
        $profession_cert = $request->profession_cert;
        $overall_grade = $request->overall_grade;
        $id = $request->id;
        $staff_id = $request->staff_id;

        DB::beginTransaction();
        try{
            $m = $id ? StaffAcademic::find($id) : new StaffAcademic;
            $m->staff_id = $staff_id;
            $m->academic_qualification_id = $qualification;
            $m->certificate_name = $cert_name;
            $m->institution_name = $institution_name;
            $m->institution_location = $institution_location;
            $m->major_specialization = $major_specialization;
            $m->minor_specialization = $minor_specialization;
            $m->professional_certification = $profession_cert;
            $m->professional_certification_date = $profession_cert_date ? $this->reverseDate($profession_cert_date) : null;
            $m->overall_grade = $overall_grade;
            $m->save();

            $complete = StaffAcademic::where('staff_id', $staff_id)->count();
            $staff = Staff::find($staff_id);
            $staff->academic_complete = $complete > 0;
            $staff->save();

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => $exception->getMessage(),
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Rekod Akademik '.($id ? 'Dikemaskini' : 'Ditambah'),
        ];
    }

    public function getAcademic($id){
        $data = [];

        $m = StaffAcademic::find($id);
        $data['id'] = $m->id;
        $data['academic_qualification_id'] = $m->academic_qualification_id;
        $data['certificate_name'] = $m->certificate_name;
        $data['institution_name'] = $m->institution_name;
        $data['institution_location'] = $m->institution_location;
        $data['major_specialization'] = $m->major_specialization;
        $data['minor_specialization'] = $m->minor_specialization;
        $data['professional_certification'] = $m->professional_certification;
        $data['professional_certification_date'] = $m->professional_certification_date ? $this->regularDate($m->professional_certification_date) : null;
        $data['overall_grade'] = $m->overall_grade;
        return $data;
    }

    public function getFamilyList(Request $request){
        $staff_id = $request->staff_id;

        $model = DB::select('
            SELECT
            sf.id,
            sf.name,
            sf.dob,
            sf.email,
            sf.gender,
            sf.phone,
            sf.relation
            FROM staff_families sf
            JOIN staffs s ON s.id = sf.staff_id
            AND sf.staff_id = ?
            LIMIT 100
        ',[
            $staff_id
        ]);

        return $model;
    }

    public function storeUpdateFamily(Request $request){
        $fam_name = $request->fam_name;
        $fam_email = $request->fam_email;
        $fam_relation = $request->fam_relation;
        $fam_phone = $request->fam_phone;
        $fam_dob = $request->fam_dob;
        $id = $request->id;
        $staff_id = $request->staff_id;

        DB::beginTransaction();
        try{
            $m = $id ? StaffFamily::find($id) : new StaffFamily;
            $m->staff_id = $staff_id;
            $m->name = $fam_name;
            $m->email = $fam_email;
            $m->relation = $fam_relation;
            $m->phone = $fam_phone;
            $m->gender = 1;
            $m->dob = $fam_dob ? $this->reverseDate($fam_dob) : null;
            $m->save();

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => $exception->getMessage(),
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Rekod Maklumat Keluarga '.($id ? 'Dikemaskini' : 'Ditambah'),
        ];
    }

    public function getFamily($id){
        $data = [];

        $m = StaffFamily::find($id);
        $data['id'] = $m->id;
        $data['name'] = $m->name;
        $data['relation'] = $m->relation;
        $data['phone'] = $m->phone;
        $data['email'] = $m->email;
        $data['dob'] = $m->dob ? $this->regularDate($m->dob) : null;
        return $data;
    }

    public function setAppointedDate(Request $request){
        $date = $request->date;
        $staff_id = $request->staff_id;

        $m = $this->getStaffProfile($staff_id);
//        echo '<pre>';
//        print_r($m);
//        echo '</pre>';
//        die();
        $m->date_appointed = $date ? $this->reverseDate($date) : null;
        $m->save();

        return [
            'status' => 'success',
            'message' => 'Tarikh Pelantikan Dikemaskini',
        ];

    }
}
