<?php

namespace App\Http\Controllers;

use App\Survey;
use App\SurveyCsv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::paginate(10);
        return view('dashboard',compact('surveys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "survey" => 'required|array'
        ]);

        $survey_uuid = Str::uuid();
        $questions   = config('survey.questions');
        $sections    = config('survey.sections');
        $answers     = $request->survey;

        if(count($questions) != count($answers)){
            return response()->json([
                'status' => '403',
                'message' => 'Question Answer Array Mismatch Error',
            ], 403);
        }

        $survey = Survey::create([
            'survey_uuid' => $survey_uuid,
            'survey' => $request->survey
        ]);

        foreach($answers as $key => $answer){
            $question = $questions[$key]['q'];
            $section_group = $questions[$key]['section'];
            $section  = $sections[$section_group]['title'];

            if($questions[$key]['ans']['type']=='multiple' || $questions[$key]['ans']['type']=='multipleWithOtherOpt'){
                $ans = $str = implode (", ", $answer);
            }
            else{
                $ans = $answer;
            }

            SurveyCsv::create([
                'survey_uuid'   =>  $survey_uuid,
                'ipad_udid'     =>  $survey_uuid,
                'section_group' =>  $section_group,
                'section'       =>  $section,
                'question'      =>  $question,
                'answer'        =>  $ans
            ]);
        }

        return response()->json([
            'status'  => 200,
            'message' => 'Suvey Stored Successfully'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey = Survey::find($id);
        // return $survey;
        return view('surveyDetails',compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function store_csv($answers, $survey_uuid)
    {
        $questions = config('survey.questions');
        $sections  = config('survey.sections');
        // $answers   = json_decode('{"0":1,"1":"yes","2":["hy","hello"],"3":"very Good","4":["testone","testtwo"],"5":"very Good","6":"very Good","7":"very Good"}', true);
        // $answers   = json_decode($jsonSurvey, true);

        if(count($questions) != count($answers)){
            return response()->json([
                'status' => '403',
                'message' => 'Question Answer Array Mismatch Error',
            ], 403);
        }
        $structured_db = [];
        foreach($answers as $key => $answer){
            $question = $questions[$key]['q'];
            $section_group = $questions[$key]['section'];
            $section  = $sections[$section_group]['title'];

            if($questions[$key]['ans']['type']=='multiple'){
                $ans = $str = implode (", ", $answer);
            }
            else{
                // $ans = $questions[$key]['ans']['label'][$answer];
                $ans = $answer;
            }

            SurveyCsv::create([
                'survey_uuid'   =>  $survey_uuid,
                'ipad_udid'     =>  $survey_uuid,
                'section_group' =>  $section_group,
                'section'       =>  $section,
                'question'      =>  $question,
                'answer'        =>  $ans
            ]);
            // if($key==1){
            //     return $ans;
            // }
        }
        return true;
    }

    public function generate_csv()
    {
        $surveys = SurveyCsv::all()->groupBy(['survey_uuid', 'section_group']);

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = [
            'SURVEY ID',
            'SECTION',
            'QUESTION',
            'ANSWER'
        ];

        //Save all repeated Categories with ancestors
        $out = fopen(storage_path().DS."csv".DS."survey.csv", 'w');
        fputcsv($out, $columns);

        foreach($surveys as $survey_uuid => $section_group){
            fputcsv($out, array($survey_uuid, '', '', ''));
            foreach($section_group as $key => $section){
                foreach($section as $key => $survey){
                    if($key==0){
                        fputcsv($out, array('', iconv('UTF-8', 'Windows-1252', $survey['section']), iconv('UTF-8', 'Windows-1252', $survey['question']), $survey['answer']));
                    }
                    else{
                        fputcsv($out, array('', '', iconv('UTF-8', 'Windows-1252', $survey['question']), $survey['answer']));
                    }
                }
            }
            fputcsv($out, array('', '', '', ''));
            fputcsv($out, array('', '', '', ''));
        }

        fclose($out);
        return response()->download(storage_path().DS."csv".DS."survey.csv");
    }
    public function generate_csv_unfiltered()
    {
        $surveys = SurveyCsv::all();

        $columns = [
            'SURVEY ID',
            'SECTION',
            'QUESTION',
            'ANSWER'
        ];

        //Save all repeated Categories with ancestors
        $out = fopen(storage_path().DS."csv".DS."survey_m.csv", 'w');
        fputcsv($out, $columns);
          
        foreach($surveys as $survey)
        {
            fputcsv($out, array($survey->survey_uuid,$survey->section, $survey->question, $survey->answer));
        }

        fclose($out);

        return $surveys;
    }

    public function test()
    {
        $questions = config('survey.questions');
        $sections  = config('survey.sections');
        $likita = '{"0":5,"1":null,"2":null,"3":null,"4":null,"5":null,"6":5,"7":null,"8":5,"9":"No","10":5,"11":null,"12":{"Agriculture":"Agriculture","ArtandDesign":"Art and Design"},"13":["Transparency","Accountability","Privacy"],"14":4,"15":5,"16":"Blockchain & Digital Currency","17":"Bjik"}';
        return json_decode($likita,true);
        // return print_r($questions);
    }
}
